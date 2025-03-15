<?php 
require "admin/inc/config.php";
require "admin/inc/function.php";
require_once 'inc/stripe/init.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
{
   redirect('index');
   exit();
}

$form_data = filtration($_POST);

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
header('Content-Type: application/json');

$YOUR_DOMAIN = SITE_PATH;

$payment = $_SESSION['room']['payment'];

$checkout_session = \Stripe\Checkout\Session::create([
   'line_items' => [[
    'price_data' => [
        'currency' => 'usd',
        'product_data' => [
           'name' => $_SESSION['room']['name'], // Change this to your product name
        ],
        'unit_amount' => $payment * 100, // Amount in cents ($10.00)
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'pay_response?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . 'pay-canceled.html',
]);

$session_id = $checkout_session->id;

// initially insert all details on db as request pending

$order_id = random_int(100000,999999);

$query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `session_id`, `trans_amt`) VALUES (?,?,?,?,?,?,?)";

insert($query1, "iissssd", [$_SESSION['USER_ID'], $_SESSION['room']['id'], $form_data['checkin'], $form_data['checkout'], $order_id, $session_id, $_SESSION['room']['payment']]);

$booking_id = mysqli_insert_id($conn);

$query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phone_num`, `address`) VALUES (?,?,?,?,?,?,?)";
insert($query2, 'isddsss',[$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $_SESSION['room']['payment'], $form_data['name'], $form_data['phone_no'], $form_data['address']]);


header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url); 

?>