<?php 
require "../admin/inc/config.php";
require "../admin/inc/function.php";

if($_POST['action'] == "basic_info")
{
    $form_data = filtration($_POST);

    $query1 = "SELECT * FROM `user_cred` WHERE `phone_number` = ? AND `id` != ?";
    $result1 = select($query1, 'si', [$form_data['phone_number'], $_SESSION['USER_ID']]);

    if($result1->num_rows > 0)
    {
        echo "phone_already";
        exit();
    }

    $query2 = "UPDATE `user_cred` SET `name`= ?,`phone_number`= ?,`address`= ?,`pincode`= ?,`dob`= ? WHERE `id` = ?";

    $data_types = 'sssssi';
    $values = [$form_data['name'], $form_data['phone_number'], $form_data['address'], $form_data['pincode'], $form_data['dob'], $_SESSION['USER_ID']];

    if(update($query2, $data_types, $values))
    {
        $_SESSION['USER_NAME'] = $form_data['name'];
        echo 1;
    }
    else 
    {
        echo 0;
    }
}

if($_POST['action'] == "picture_update")
{
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

    $query1 = "SELECT picture FROM `user_cred` WHERE `id` = ?";
    $result1 = select($query1, 'i', [$_SESSION['USER_ID']]);
    $row1 = $result1->fetch_assoc();

    deleteImage($row1['picture'], 'users/');

    $query2 = "UPDATE `user_cred` SET `picture`= ? WHERE `id` = ?";

    $data_types = 'si';
    $values = [$img_res, $_SESSION['USER_ID']];

    if(update($query2, $data_types, $values))
    {
        $_SESSION['USER_PIC'] = $img_res;
        echo 1;
    }
    else 
    {
        echo 0;
    }

}

if($_POST['action'] == "password_update")
{
    $form_data = filtration($_POST);

    if($form_data['new_pass'] != $form_data['con_pass'])
    {
        echo "mismatch";
        exit();
    }

    $enc_pass = password_hash($form_data['new_pass'], PASSWORD_BCRYPT);

    $query = "UPDATE `user_cred` SET `pass`= ? WHERE `id` = ?";

    $data_types = 'si';
    $values = [$enc_pass, $_SESSION['USER_ID']];

    if(update($query, $data_types, $values))
    {
        echo 1;
    }
    else 
    {
        echo 0;
    }

}

?>