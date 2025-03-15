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