<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";

if($_POST['action'] == "cancel_booking")
{
    $form_data = filtration($_POST);

    $query = "UPDATE `booking_order` SET `refund`= ?,`booking_status`= ?
              WHERE `booking_id` = ? AND `user_id` = ?";

    $data_types = 'isii';
    $values = [0, 'cancelled', $form_data['id'], $_SESSION['USER_ID']];

    echo update($query, $data_types, $values);
}



?>