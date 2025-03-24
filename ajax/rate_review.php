<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";

if($_POST['action'] == "rate_review")
{
    $form_data = filtration($_POST);

    $query1 = "UPDATE `booking_order` SET `rate_review`= ?
              WHERE `booking_id` = ? AND `user_id` = ?";

    $data_types1 = 'iii';
    $values1 = [1, $form_data['booking_id'], $_SESSION['USER_ID']];
    update($query1, $data_types1, $values1);

    // insert rate review

    $query2 = "INSERT INTO `rate_review`(`booking_id`, `room_id`, `user_id`, `rating`, `review`) VALUES (?,?,?,?,?)";
    $data_types2 = 'iiiis';
    $values2 = [$form_data['booking_id'], $form_data['room_id'], $_SESSION['USER_ID'], $form_data['rate'], $form_data['review']];

    echo insert($query2, $data_types2, $values2);
}


?>