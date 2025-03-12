<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";
include('../smtp/smtp/PHPMailerAutoload.php');

function send_mail($email, $token, $subject_r, $type)
{
    $t_date = date('Y-m-d');

    if($type == "register")
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

    }
    if($type == "reset")
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
                Click here to reset your password <br>
                <a href="'.SITE_PATH.'index?email='.$email.'&token='.$token.'&date='.$t_date.'&type=reset">Click me</a>
            </div>
        </body>
        </html>';
    }
    
    $subject = $subject_r.COMPANY_NAME."";

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

    if(send_mail($form_data['email'], $token, "Account verification of", "register"))
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

if(isset($_POST['action']) && $_POST['action'] == "login")
{
    $form_data = filtration($_POST);

    $user_exist =select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phone_number` = ? LIMIT 1", "ss", [$form_data['email_mob'], $form_data['email_mob']]);
    
    if($user_exist->num_rows == 0)
    {
        echo "invalid_email_mob";
    }
    else 
    {
        $user_row = $user_exist->fetch_assoc();

        if($user_row['is_verified'] == 0)
        {
            echo "not_verified";
        }
        else if($user_row['status'] == 0)
        {
            echo "suspended";
        }
        else 
        {
            if(password_verify($form_data['password'], $user_row['pass']))
            {
                echo "success";

                $_SESSION['LOGIN'] = true;
                $_SESSION['USER_ID'] = $user_row['id'];
                $_SESSION['USER_NAME'] = $user_row['name'];
                $_SESSION['USER_EMAIL'] = $user_row['email'];
                $_SESSION['USER_PHONE'] = $user_row['phone_number'];
                $_SESSION['USER_PIC'] = $user_row['picture'];
            }
            else 
            {
                echo "invalid_pass";
            }
        }
    }
}

if(isset($_POST['action']) && $_POST['action'] == "forgot_pass")
{
    $form_data = filtration($_POST);

    $user_exist =select("SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1", "s", [$form_data['email']]);
    
    if($user_exist->num_rows == 0)
    {
        echo "invalid_email";
    }
    else 
    {
        $user_row = $user_exist->fetch_assoc();

        if($user_row['is_verified'] == 0)
        {
            echo "not_verified";
        }
        else if($user_row['status'] == 0)
        {
            echo "suspended";
        }
        else 
        {
            $token = bin2hex(random_bytes(16));
            $t_date = date('Y-m-d');

            if(send_mail($form_data['email'], $token, "Reset Password Link of", "reset"))
            {
                $up_res = update("UPDATE `user_cred` SET `token`= ?,`token_exp`= ? WHERE `email` = ?", "sss", [$token, $t_date, $form_data['email']]);

                if($up_res)
                {
                    echo "success";
                }
                else 
                {
                    echo "failed";
                }
            }
            else 
            {
                echo "mail_failed";
            }
        }

    }

}

if(isset($_POST['action']) && $_POST['action'] == "set_password")
{
    $form_data = filtration($_POST);

    //check token valid
    $t_date = date('Y-m-d');

    $user_exist =select("SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1", "ss", [$form_data['email'], $form_data['token']]);
    
    if($user_exist->num_rows == 0)
    {
        echo "invalid_token";
    }
    else 
    {
        $user_row = $user_exist->fetch_assoc();
        $token_exp = $user_row['token_exp'];

        if($t_date > $token_exp)
        {
            echo "expire_token";
        }
        else 
        {
            $c_pass = password_hash($form_data['pass'], PASSWORD_BCRYPT);

            $up_res = update("UPDATE `user_cred` SET `pass` = ?, `token` = ?, `token_exp` = ? WHERE `email`= ? AND `token` = ?", "sssss", [$c_pass, null, null, $form_data['email'], $form_data['token']]);
        
            if($up_res)
            {
                echo "success";
            }
            else 
            {
                echo "failed";
            }
        }
    }
   
}


?>