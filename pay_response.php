<?php 
require "admin/inc/config.php";
require "admin/inc/function.php";
require_once 'inc/stripe/init.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY); 

function regenerate_session($user_id)
{
    $user_res = select("SELECT * FROM `user_cred` WHERE `id` = ?", 'i', [$user_id]);
    $user_row = $user_res->fetch_assoc();

    $_SESSION['LOGIN'] = true;
    $_SESSION['USER_ID'] = $user_row['id'];
    $_SESSION['USER_NAME'] = $user_row['name'];
    $_SESSION['USER_EMAIL'] = $user_row['email'];
    $_SESSION['USER_PHONE'] = $user_row['phone_number'];
    $_SESSION['USER_ADDRESS'] = $user_row['address'];
    $_SESSION['USER_PIC'] = $user_row['picture'];
}

if (isset($_GET['session_id']))
{
    $form_data = filtration($_GET);
    $session_id = $form_data['session_id'];

    // fetch db data based on session_id

    $booking_res = select("SELECT `booking_id`, `user_id`, `order_id` FROM `booking_order` WHERE `session_id` = ?", 's', [$session_id]);
    if($booking_res->num_rows == 0)
    {
        redirect('index');
    }

    $booking_row = $booking_res->fetch_assoc();

    if(!(isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == true))
    {
      regenerate_session($booking_row['user_id']); 
    }
    
    try 
    {
        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        $payment_intent_id = $checkout_session->payment_intent;
        $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);

        $transaction_id = $payment_intent->id; 
        $status = $payment_intent->status;

        if($status == "succeeded")
        {
            $res = update("UPDATE `booking_order` SET `booking_status`= ?, `trans_id`= ?, `trans_status`= ? WHERE `session_id` = ? AND `user_id` = ?", "ssssi", ["booked", $transaction_id, $status, $session_id, $booking_row['user_id']]);
        }

        redirect('pay-status?order_id='.$booking_row['order_id']);
         
    } 
    catch (\Stripe\Exception\ApiErrorException $e) 
    {
       echo $e;
    }
}
else 
{
    redirect('index');
}


?>