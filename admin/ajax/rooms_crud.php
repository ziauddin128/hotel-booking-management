<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['action']) && $_POST['action'] == "add_room")
  {
    $form_data = filtration($_POST);

    $flag = 0;

    $sql = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $data_types = "sddiiis";
    $values = [$form_data['name'], $form_data['area'],$form_data['price'],$form_data['quantity'],$form_data['adult'], $form_data['children'], $form_data['description']];
    
    if(insert($sql, $data_types, $values))
    {
      $flag = 1;
    }

    $room_id = mysqli_insert_id($conn);

    $q2 = "INSERT INTO `room_features`(`room_id`, `feature_id`) VALUES (?,?)";
    if($q2_res = $conn->prepare($q2))
    {
      foreach ($form_data['features'] as $f) {
        $q2_res->bind_param('ii', $room_id, $f);
        $q2_res->execute();
      }
    }
    else 
    {
      $flag = 0;
      die('Room feature prepare failed - Insert');
    }

    $q3 = "INSERT INTO `room-facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    if($q3_res = $conn->prepare($q3))
    {
      foreach ($form_data['facilities'] as $f) {
        $q3_res->bind_param('ii', $room_id, $f);
        $q3_res->execute();
      }
    }
    else 
    {
      $flag = 0;
      die('Room facilities prepare failed - Insert');
    }

    if($flag == 1)
    {
      echo 1;
    }
    else 
    {
      echo 0;
    }
  }

  if(isset($_POST['get_rooms']))
  {
    $query = "SELECT * FROM `rooms` WHERE `removed` != ? ORDER BY `id` DESC";
    $data_types = "i";
    $values = ["1"];
    $result = select($query,$data_types,$values);

    $html = '';
    $sl = 1;
    while($row = $result->fetch_assoc())
    {
      if($row['status'] == 1)
      {
        $s_btn = '<button class="btn btn-primary btn-sm shadow-none" onclick="room_status(0, '.$row['id'].')">Active</button>';
      }
      else 
      {
        $s_btn = '<button class="btn btn-secondary btn-sm shadow-none" onclick="room_status(1, '.$row['id'].')">Inactive</button>';
      }

      $html .= '<tr>
        <td>'.$sl.'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['area'].' sq.ft</td>
        <td>$'.$row['price'].'</td>
        <td>'.$row['quantity'].'</td>
        <td><span class="badge text-bg-light text-dark">Adult: '.$row['adult'].'</span> <br> <span class="badge text-bg-light text-dark">Children: '.$row['children'].'</span></td>
        <td>'.$s_btn.'</td>
        <td>
          <button class="btn btn-warning shadow-none" title="Edit" onclick="show_room_det('.$row['id'].')" data-bs-toggle="modal" data-bs-target="#room-edit-s"><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-success shadow-none" title="Image" onclick="show_room_image('.$row['id'].')" data-bs-toggle="modal" data-bs-target="#image-s"><i class="bi bi-image"></i></button>
          <button class="btn btn-danger shadow-none" title="Delete" onclick="room_remove('.$row['id'].')"><i class="bi bi-trash"></i></button>
        </td>
      </tr>';
      $sl++;
    }
    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "room_status")
  {
    $form_data = filtration($_POST);

    $sql = "UPDATE `rooms` SET `status`= ? WHERE `id`= ?";
    $data_types = "ii";
    $values = [$form_data['val'], $form_data['id']];
    $result = update($sql, $data_types, $values);
    echo $result;
  }

  if(isset($_POST['action']) && $_POST['action'] == "show_room_det")
  {
    $form_data = filtration($_POST);

    $q1 = select("SELECT * FROM `rooms` WHERE `id` = ?", 'i', [$form_data['id']]);
    $q2 = select("SELECT * FROM `room_features` WHERE `room_id` = ?", 'i', [$form_data['id']]);
    $q3 = select("SELECT * FROM `room-facilities` WHERE `room_id` = ?", 'i', [$form_data['id']]);

    $room_data = $q1->fetch_assoc();
    $features = [];
    $facilities = [];

    while($features_row = $q2->fetch_assoc())
    {
      array_push($features, $features_row['feature_id']);
    }

    while($facilities_row = $q3->fetch_assoc())
    {
      array_push($facilities, $facilities_row['facilities_id']);
    }

    $result = ["room_data" => $room_data, "features" => $features, "facilities" => $facilities];
    echo json_encode($result);
  }

  if(isset($_POST['action']) && $_POST['action'] == "edit_room")
  {
    $form_data = filtration($_POST);

    $flag = 0;

    $sql = "UPDATE `rooms` SET `name` = ?, `area` = ?, `price` = ?, `quantity` = ?, `adult` = ?, `children` = ?, `description` = ? WHERE `id` = ?";
    $data_types = "sddiiisi";
    $values = [$form_data['name'], $form_data['area'],$form_data['price'],$form_data['quantity'],$form_data['adult'], $form_data['children'], $form_data['description'], $form_data['room_id']];
    
    if(update($sql, $data_types, $values))
    {
      $flag = 1;
    }

    $del_q2 = delete("DELETE FROM `room_features` WHERE `room_id` = ?", 'i', [$form_data['room_id']]);
    $del_q3 = delete("DELETE FROM `room-facilities` WHERE `room_id` = ?", 'i', [$form_data['room_id']]);


    $q2 = "INSERT INTO `room_features`(`room_id`, `feature_id`) VALUES (?,?)";
    if($q2_res = $conn->prepare($q2))
    {
      foreach ($form_data['features'] as $f) {
        $q2_res->bind_param('ii', $form_data['room_id'], $f);
        $q2_res->execute();
      }
      $flag = 1;
    }
    else 
    {
      $flag = 0;
      die('Room feature prepare failed - Update');
    }

    $q3 = "INSERT INTO `room-facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
    if($q3_res = $conn->prepare($q3))
    {
      foreach ($form_data['facilities'] as $f) {
        $q3_res->bind_param('ii', $form_data['room_id'], $f);
        $q3_res->execute();
      }
      $flag = 1;
    }
    else 
    {
      $flag = 0;
      die('Room facilities prepare failed - Update');
    }

    if($flag == 1)
    {
      echo 1;
    }
    else 
    {
      echo 0;
    }
  }


  if(isset($_POST['action']) && $_POST['action'] == "show_room_image")
  {
    $form_data = filtration($_POST);

    $q1 = select("SELECT * FROM `room_image` WHERE `room_id` = ?", 'i', [$form_data['id']]);

    $html = '';
    $sl = 1;
    while ($row = $q1->fetch_assoc()) 
    {
      if($row['thumb'] == 0)
      {
        $thumb_btn = '<button type="button" class="btn btn-secondary shadow-none" onclick="set_thumbnail('.$form_data['id'].','.$row['id'].')"><i class="bi bi-check-lg"></i></button>';
      }
      else 
      {
        $thumb_btn = '<span class="btn btn-primary shadow-none"><i class="bi bi-check-lg"></i></span>';
      }

      $html .= '<tr class="align-middle">
        <td>'.$sl.'</td>
        <td><img src="'.IMAGE_PATH.'rooms/'.$row['image'].'" width="120px"></td>
        <td>'.$thumb_btn.'</td>
        <td><button type="button" class="btn btn-danger btn-sm shadow-none" onclick="image_remove('.$form_data['id'].','.$row['id'].')">Delete</button></td>
      </tr>';
      $sl++;
    }
    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "add_image")
  {
    $form_data = filtration($_POST);

    $image_res = upload_image($_FILES['image'], "rooms/");

    if($image_res == "invalid_format")
    {
      echo $image_res;
    }
    else if($image_res == "invalid_size")
    {
      echo $image_res;
    }
    else if($image_res == "upload_failed")
    {
      echo $image_res;
    }
    else 
    {
      $sql = "INSERT INTO `room_image`(`room_id`, `image`) VALUES (?,?)";
      $data_types = "is";
      $values = [$form_data['room_id'], $image_res];
      $result = insert($sql, $data_types, $values);
      echo $result;
    }
  
  }

  if(isset($_POST['action']) && $_POST['action'] == "set_thumbnail")
  {
    $form_data = filtration($_POST);

    $set_default =  update("UPDATE `room_image` SET `thumb`= ? WHERE `room_id` = ?", 'ii', [0, $form_data['room_id']]);

    $q1 = "UPDATE `room_image` SET `thumb`= ? WHERE `room_id` = ? AND `id` = ?";
    $data_types = "iii";
    $values = [1, $form_data['room_id'], $form_data['id']];
    $result = update($q1, $data_types, $values);
    echo $result;
  }

  if(isset($_POST['action']) && $_POST['action'] == "image_remove")
  {
    $form_data = filtration($_POST);

    $sql = "SELECT * FROM `room_image` WHERE `room_id` = ? AND `id` = ?";
    $data_types = 'ii';
    $values = [$form_data['room_id'], $form_data['id']];
    $res = select($sql, $data_types, $values);
    $row = $res->fetch_assoc();

    $is_delete = deleteImage($row['image'], "rooms/");

    if($is_delete)
    {
      $sql = "DELETE FROM `room_image` WHERE `room_id` = ? AND `id` = ?";
      $result = delete($sql, $data_types, $values);
      echo $result; 
    }
    else 
    {
      echo 0;
    }

  }


  if(isset($_POST['action']) && $_POST['action'] == "room_remove")
  {
    $form_data = filtration($_POST);
    
    $sql = "SELECT * FROM `room_image` WHERE `room_id` = ?";
    $data_types = 'i';
    $values = [$form_data['id']];
    $res = select($sql, $data_types, $values);
   
    while($row = $res->fetch_assoc())
    {
      deleteImage($row['image'], "rooms/");

      $sql = "DELETE FROM `room_image` WHERE `room_id` = ?";
      $result = delete($sql, $data_types, $values);
    }

    $q1 = update("UPDATE `rooms` SET `removed` = ? WHERE `id` = ?", 'ii', [1,$form_data['id']]);
    $q2 = delete("DELETE FROM `room_features` WHERE `room_id` = ?", 'i', [$form_data['id']]);
    $q3 = delete("DELETE FROM `room-facilities` WHERE `room_id` = ?", 'i', [$form_data['id']]);
    
    if(($q1 && $q2 && $q3))
    {
      echo 1;
    }
    else 
    {
      echo 0;
    }
  }


?>