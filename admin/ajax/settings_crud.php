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


?>