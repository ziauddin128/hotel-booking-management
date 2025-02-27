<?php 
  require "../inc/config.php";
  require "../inc/function.php";
  adminLogin();

  if(isset($_POST['get_general']))
  {
    $query = "SELECT * FROM `settings` WHERE `id` = ?";
    $data_types = "i";
    $values = ["1"];

    $result = select($query,$data_types,$values);
    $row = $result->fetch_assoc();
    echo json_encode($row);
  }

  if(isset($_POST['action']) && $_POST['action'] == "setting_update")
  {
     $form_data = filtration($_POST);

    $sql = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `id`= ?";
    $data_types = "ssi";
    $values = [$form_data['site_title'], $form_data['site_about'], 1];

    $result = update($sql, $data_types, $values);
    echo $result;
  }

  if(isset($_POST['action']) && $_POST['action'] == "shutdown_update")
  {
    $val = $_POST['val'];

    $update_val = ($val == "0") ? "1" : "0";

    $sql = "UPDATE `settings` SET `shutdown`= ? WHERE `id`= ?";
    $data_types = "ii";
    $values = [$update_val, 1];

    $result = update($sql, $data_types, $values);
    echo $result;
  }

  if(isset($_POST['get_contacts']))
  {
    $query = "SELECT * FROM `contacts_det` WHERE `id` = ?";
    $data_types = "i";
    $values = ["1"];

    $result = select($query,$data_types,$values);
    $row = $result->fetch_assoc();
    echo json_encode($row);
  }
  
  if(isset($_POST['action']) && $_POST['action'] == "contacts_update")
  {
    $form_data = filtration($_POST);

    $sql = "UPDATE `contacts_det` SET `address`=?,`gmap`=?,`phn1`=?,`phn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `id` = ?";
    
    $data_types = "sssssssssi";
    $values = [$form_data['address'], $form_data['gmap'], $form_data['phn1'], $form_data['phn2'],$form_data['email'],$form_data['fb'],$form_data['insta'],$form_data['tw'],$form_data['iframe'], 1];
    $result = update($sql, $data_types, $values);
    echo $result; 
  }
  
  if(isset($_POST['action']) && $_POST['action'] == "add_management_team")
  {
    $form_data = filtration($_POST);

    $image_res = upload_image($_FILES['member_picture'], "about/");

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
      $sql = "INSERT INTO `team_details`(`member_name`, `member_picture`) VALUES (?,?)";
      $data_types = "ss";
      $values = [$form_data['member_name'], $image_res];
      $result = insert($sql, $data_types, $values);
  
      echo $result;
    }
  
  }

  if(isset($_POST['get_members']))
  {
    $res = selectAll('team_details');

    $html = '';
    while ($row = mysqli_fetch_assoc($res)) 
    {
      $html .='<div class="col-sm-6 col-md-3 col-xl-2 mb-3">
                <div class="card">
                  <img src="'.SITE_PATH.'assets/images/about/'.$row['member_picture'].'" style="height: 220px; object-fit: cover; object-position: center">
                  <div class="card-img-overlay text-end">
                     <button class="btn btn-danger shadow-none" onclick="remove_member('.$row['id'].')"><i class="bi bi-trash"></i> Delete</button>
                  </div>
                  <h5 class="card-title text-center text-white bg-dark m-0 py-2 px-2">'.$row['member_name'].'</h5>
                </div>
              </div>';
    }

    echo $html;
  }

  if(isset($_POST['action']) && $_POST['action'] == "remove_member")
  {
    $form_data = filtration($_POST);

    $sql = "SELECT * FROM `team_details` WHERE `id` = ?";
    $data_types = 'i';
    $values = [$form_data['id']];
    $res = select($sql, $data_types, $values);
    $row = $res->fetch_assoc();

    $is_delete = deleteImage($row['member_picture'], "about/");

    if($is_delete)
    {
      $sql = "DELETE FROM `team_details` WHERE `id` = ?";
      $result = delete($sql, $data_types, $values);
      echo $result; 
    }
    else 
    {
      echo 0;
    }

  }
  

?>