<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  
  if(isset($_POST['action']) && $_POST['action'] == "add_feature")
  {
    $form_data = filtration($_POST);

    $sql = "INSERT INTO `features`(`feature_name`) VALUES (?)";
    $data_types = "s";
    $values = [$form_data['feature_name']];
    $result = insert($sql, $data_types, $values);

    echo $result;
  
  }

  if(isset($_POST['get_features']))
  {
    $res = selectAll('features');

    $html = '';
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) 
    {
      $html .='<tr>
        <td>'.$i.'</td>
        <td>'.$row['feature_name'].'</td>
        <td>
          <button class="btn btn-danger shadow-none" onclick="remove_feature('.$row['id'].')"><i class="bi bi-trash"></i> Delete</button>
        </td>
      </tr>';

      $i++;
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "remove_feature")
  {
    $form_data = filtration($_POST);

    $data_types = 'i';
    $values = [$form_data['id']];

    $sql = "DELETE FROM `features` WHERE `id` = ?";
    $result = delete($sql, $data_types, $values);
    echo $result; 

  }


  if(isset($_POST['action']) && $_POST['action'] == "add_facility")
  {
    $form_data = filtration($_POST);

    $image_res = uploadSVGimage($_FILES['facility_icon'], "facilities/");

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

      $sql = "INSERT INTO `facilities`(`facility_icon`, `facility_name`, `facility_desc`) VALUES (?,?,?)";
      $data_types = "sss";
      $values = [$image_res, $form_data['facility_name'], $form_data['facility_desc']];
      $result = insert($sql, $data_types, $values);
  
      echo $result;
    }
  
  }


  if(isset($_POST['get_facilities']))
  {
    $res = selectAll('facilities');

    $html = '';
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) 
    {
      $html .='<tr class="align-middle">
        <td>'.$i.'</td>
        <td><img src="'.IMAGE_PATH.'facilities/'.$row['facility_icon'].'" style="width:100px"></td>
        <td>'.$row['facility_name'].'</td>
        <td>'.$row['facility_desc'].'</td>
        <td>
          <button class="btn btn-danger shadow-none" onclick="remove_facility('.$row['id'].')"><i class="bi bi-trash"></i> Delete</button>
        </td>
      </tr>';

      $i++;
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "remove_facility")
  {
    $form_data = filtration($_POST);

    $sql = "SELECT * FROM `facilities` WHERE `id` = ?";
    $data_types = 'i';
    $values = [$form_data['id']];
    $res = select($sql, $data_types, $values);
    $row = $res->fetch_assoc();

    $is_delete = deleteImage($row['facility_icon'], "facilities/");

    if($is_delete)
    {
      $sql = "DELETE FROM `facilities` WHERE `id` = ?";
      $result = delete($sql, $data_types, $values);
      echo $result; 
    }
    else 
    {
      echo 0;
    }

  } 

  

?>