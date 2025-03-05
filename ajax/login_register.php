<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";
include('../smtp/smtp/PHPMailerAutoload.php');

function send_mail($email, $token)
{
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
            Click here to verify you account <br>
            <a href="'.SITE_PATH.'confirm-email?email='.$email.'&token='.$token.'">Click me</a>
        </div>
    </body>
    </html>';
    
    $subject = "Account verification of ".COMPANY_NAME."";

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
    $mail->Password = "qaic zzbk jifq dxpp"; // Your Gmail password
    $mail->SetFrom("test12web2000@gmail.com", COMPANY_NAME); // Set from email with company name
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
        return 1;
    } 
    else 
    {
        return 0;
    } 
}

if(isset($_POST['action']) && $_POST['action'] == "register")
{   
    $form_data = filtration($_POST);

    // is both password mis match

    if($form_data['pass'] !== $form_data['cpass'])
    {
        echo "password_mismatch";
        exit();
    }

    // if user already exists

    $user_exists = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phone_number` = ? LIMIT 1", "ss", [$form_data['email'], $form_data['phone_number']]);
    
    if($user_exists->num_rows > 0)
    {
        echo "user_exist";
        exit();
    }

    // upload image
    $img_res = upload_user_image($_FILES['picture']);
    if($img_res == "invalid_format")
    {
        echo "invalid_format";
        exit();
    }
    else if($img_res == "upload_failed")
    {
        echo "upload_failed";
        exit();
    }

    // send confirmation mail to user
    $token = bin2hex(random_bytes(16));
    $pass = password_hash($form_data['pass'], PASSWORD_BCRYPT);

    if(send_mail($form_data['email'], $token))
    {
        $q = "INSERT INTO `user_cred`(`name`, `email`, `phone_number`, `picture`, `address`, `pincode`, `dob`, `pass`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
        $data_types = 'sssssssss';

        $values = [$form_data['name'], $form_data['email'], $form_data['phone_number'],  $img_res,$form_data['address'], $form_data['pincode'], $form_data['dob'] ,$pass, $token];
        
        if(insert($q, $data_types, $values))
        {
            echo 1;
        }
        else 
        {
            echo 0;
        }
    }
    else 
    {
        echo "mail_failed";
        exit();
    }
}


?>