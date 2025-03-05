<?php 
include('smtp/PHPMailerAutoload.php');

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$message = htmlspecialchars($_POST['message']);

$body = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 640px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <p><b>NAME: </b>'.$name.'</p>
        <p><b>EMAIL: </b>'.$email.'</p>
        <p><b>PHONE: </b>'.$phone.'</p>
        <p><b>MESSAGE: </b>'.$message.'</p>
    </div>
</body>
</html>';


const COMPANY_NAME = 'Tytan Technology Inc';
const COMPANY_EMAIL = 'ziauddindev2000@gmail.com';
$email = COMPANY_EMAIL; //where message will go

$companyName = COMPANY_NAME;
$subject = "Message From ".COMPANY_NAME."";

$mail = new PHPMailer(); 
$mail->SMTPDebug  = 0;
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; 
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Username = "test12web2000@gmail.com"; // Your Gmail
$mail->Password = "tjhz qjsk xdqz xjug"; // Your Gmail password
$mail->SetFrom("test12web2000@gmail.com", $companyName); // Set from email with company name
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email); // User Gmail
$mail->SMTPOptions = array('ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => false
));

if ($mail->Send()) 
{
    $response = [
        "success" => true,
        "message" => "Message send successfully"
    ];
} else 
{
    //echo $mail->ErrorInfo;
    $response = [
        "success" => false,
        "message" => "Message send failed!"
    ];
} 

echo json_encode($response);
?>
