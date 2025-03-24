<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";


if($_POST['check_ability'])
{
    $form_data = filtration($_POST);

    $t_day = new DateTime(date('Y-m-d'));
    $checkin_day = new DateTime($form_data['checkin']);
    $checkout_day = new DateTime($form_data['checkout']);

    $status = "";
    $result = "";

    if($checkin_day == $checkout_day)
    {
        $status = "checkin_out_days_equal";
        $result = [
            "status" => $status
        ];
    }
    else if($checkin_day < $t_day)
    {
        $status = "checkin_earlier";
        $result = [
           "status" => $status
        ];
    }
    else if($checkout_day < $checkin_day)
    {
        $status = "checkout_earlier";
        $result = [
            "status" => $status
        ];
    }

    if($status != "")
    {
        echo json_encode($result);
    }
    else 
    {

        // run query to check room is available or not

        $tb_query = "SELECT COUNT(*) AS `total_bookings` FROM `booking_order` 
                    WHERE `booking_status` = ?  AND `room_id` = ?
                    AND `check_out` > ? AND `check_in` < ?";

        $values = ["booked", $_SESSION['room']['id'], $form_data['checkin'], $form_data['checkout']];

        $tb_res = select($tb_query, 'siss', $values);
        $tb_row = $tb_res->fetch_assoc();


        $room_res = select("SELECT `quantity` FROM `rooms` WHERE `id` = ?", 'i', [$_SESSION['room']['id']]);
        $room_row = $room_res->fetch_assoc();

        if(($room_row['quantity'] - $tb_row['total_bookings']) == 0)
        {
            $result = [
                "status" => "unavailable",
            ];
            echo  json_encode($result);
            exit;
        }


        $count_days = date_diff($checkin_day, $checkout_day)->days;
        $payment = $_SESSION['room']['price'] * $count_days;
        

        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;

        $result = [
            "status" => "available",
            "days" => $count_days,
            "payment" => $payment,
        ];
        echo  json_encode($result);
    }

}



?>