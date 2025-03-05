<?php 
require "admin/inc/config.php";
require "admin/inc/function.php";

if(isset($_GET['email']) && isset($_GET['token']))
{
    $form_data = filtration($_GET);

    $check = select("SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1", "ss", [$form_data['email'], $form_data['token']]);

    if($check->num_rows > 0)
    {
        $check_row = $check->fetch_assoc();
        if($check_row['is_verified'] == 1)
        {
            echo "<script>alert('You are already verified user')</script>";
            redirect('index');
        }
        else 
        {
            $up_res = update("UPDATE `user_cred` SET `is_verified` = ? WHERE `email` = ? AND `token` = ?", "iss", [1,$form_data['email'], $form_data['token']]);
            
            if($up_res == 1)
            {
                echo "<script>alert('Your account verified successfully.')</script>";
            }
            else 
            {
                echo "<script>alert('Server down')</script>";
            }
        }
    }
    else 
    {
        echo "<script>alert('Invalid token')</script>";
        redirect('index');
    }
}
else 
{
    redirect('index');
}
?>