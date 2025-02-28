<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";

if(isset($_POST['action']) && $_POST['action'] == "add_queries")
{
    $form_data = filtration($_POST);

    $sql = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
    $data_types = 'ssss';
    $values = [$form_data['name'], $form_data['email'], $form_data['subject'], $form_data['message']];
    $res = insert($sql, $data_types, $values);
    echo $res;
}


?>