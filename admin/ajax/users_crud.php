<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();


  if(isset($_POST['get_users']))
  {
    $result = selectAll('user_cred');

    $html = '';
    $sl = 1;
    while($row = $result->fetch_assoc())
    {

      if($row['is_verified'] == 1)
      {
        $v_btn = '<span class="badge text-bg-primary p-2"><i class="bi bi-check-lg"></i></span>';
      }
      else 
      {
        $v_btn = '<span class="badge text-bg-warning p-2"><i class="bi bi-x-lg"></i></span>';
      }

      if($row['status'] == 1)
      {
        $s_btn = '<button class="btn btn-primary btn-sm shadow-none" onclick="users_status(0, '.$row['id'].')">Active</button>';
      }
      else 
      {
        $s_btn = '<button class="btn btn-secondary btn-sm shadow-none" onclick="users_status(1, '.$row['id'].')">Inactive</button>';
      }

      $html .= '<tr>
        <td>'.$sl.'</td>
        <td>
        <img src="'.IMAGE_PATH.'users/'.$row['picture'].'" style="width: 60px">
        <br>
        '.$row['name'].'
        </td>
        <td>'.$row['email'].'</td>
        <td>$'.$row['phone_number'].'</td>
        <td>'.$row['address'].' <br> '.$row['pincode'].'</td>
        <td>'.$row['dob'].'</td>
        <td>'.$v_btn.'</td>
        <td>'.$s_btn.'</td>
        <td>'.date('d-m-Y', strtotime($row['date_time'])).'</td>
        <td>
          <button class="btn btn-danger shadow-none" title="Delete" onclick="user_remove('.$row['id'].')"><i class="bi bi-trash"></i></button>
        </td>
      </tr>';
      $sl++;
    }
    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "users_status")
  {
    $form_data = filtration($_POST);

    $sql = "UPDATE `user_cred` SET `status`= ? WHERE `id`= ?";
    $data_types = "ii";
    $values = [$form_data['val'], $form_data['id']];
    $result = update($sql, $data_types, $values);
    echo $result;

  }
 
  if(isset($_POST['action']) && $_POST['action'] == "user_remove")
  {
    $form_data = filtration($_POST);

    $res = delete("DELETE FROM `user_cred` WHERE `id` = ?", 'i', [$form_data['id']]);
    
    if($res)
    {
      echo 1;
    }
    else 
    {
      echo 0;
    }
  }

  if(isset($_POST['action']) && $_POST['action'] == "search_user")
  {
    $form_data = filtration($_POST);

    $searched_val = "%".$form_data['searched_name']."%";

    $result = select("SELECT * FROM `user_cred` WHERE `name` LIKE ?", "s", ["%".$form_data['searched_name']."%"]);

    $html = '';
    $sl = 1;
    while($row = $result->fetch_assoc())
    {

      if($row['is_verified'] == 1)
      {
        $v_btn = '<span class="badge text-bg-primary p-2"><i class="bi bi-check-lg"></i></span>';
      }
      else 
      {
        $v_btn = '<span class="badge text-bg-warning p-2"><i class="bi bi-x-lg"></i></span>';
      }

      if($row['status'] == 1)
      {
        $s_btn = '<button class="btn btn-primary btn-sm shadow-none" onclick="users_status(0, '.$row['id'].')">Active</button>';
      }
      else 
      {
        $s_btn = '<button class="btn btn-secondary btn-sm shadow-none" onclick="users_status(1, '.$row['id'].')">Inactive</button>';
      }

      $html .= '<tr>
        <td>'.$sl.'</td>
        <td>
        <img src="'.IMAGE_PATH.'users/'.$row['picture'].'" style="width: 60px">
        <br>
        '.$row['name'].'
        </td>
        <td>'.$row['email'].'</td>
        <td>$'.$row['phone_number'].'</td>
        <td>'.$row['address'].' <br> '.$row['pincode'].'</td>
        <td>'.$row['dob'].'</td>
        <td>'.$v_btn.'</td>
        <td>'.$s_btn.'</td>
        <td>'.date('d-m-Y', strtotime($row['date_time'])).'</td>
        <td>
          <button class="btn btn-danger shadow-none" title="Delete" onclick="user_remove('.$row['id'].')"><i class="bi bi-trash"></i></button>
        </td>
      </tr>';
      $sl++;
    }
    echo $html;
  }


?>