<?php 

// for front-end image 
define('SITE_PATH', "http://localhost/hotel/");
define('IMAGE_PATH', SITE_PATH."assets/images/");

define("COMPANY_NAME","Hotel Management");

// for backend image upload

define('UPLOAD_IMAGE_PATH', $_SERVER["DOCUMENT_ROOT"]."/hotel/assets/images/");

function adminLogin()
{
    if(!isset($_SESSION['ADMIN_ID']) && !isset($_SESSION['ADMIN_LOGIN']))
    {
        echo "<script>
        window.location.assign('index');
        </script>"; 
    }
}

function redirect($url)
{
    echo "<script>
    window.location.assign('$url');
    </script>";
}

function alert($type, $message)
{
    $alert_type = ($type == "success") ? "alert-success" : "alert-danger";

    echo '<div class="alert '.$alert_type.' custom-alert alert-dismissible fade show" role="alert">
       <strong class="me-3">'.$message.'</strong>
       <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
}

function upload_image($image, $folder)
{
    $valid_mime = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if(!in_array($img_mime, $valid_mime))
    {
        return 'invalid_format'; //Invalid image format or mime
    }
    else if($image['size'] > 2097152)
    {
        return 'invalid_size'; //Max size 2MB
    }
    else 
    {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $file_name = "IMG_".rand(10000,99999).".$extension";

        $folder_path = UPLOAD_IMAGE_PATH.$folder.$file_name;

        if(move_uploaded_file($image['tmp_name'], $folder_path))
        {
            return $file_name;
        }
        else 
        {
            return 'upload_failed'; 
        }
    }

}

function uploadSVGimage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if(!in_array($img_mime, $valid_mime))
    {
        return 'invalid_format'; //Invalid image format or mime
    }
    else if($image['size'] > 1048576)
    {
        return 'invalid_size'; //Max size 1MB
    }
    else 
    {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $file_name = "IMG_".rand(10000,99999).".$extension";

        $folder_path = UPLOAD_IMAGE_PATH.$folder.$file_name;

        if(move_uploaded_file($image['tmp_name'], $folder_path))
        {
            return $file_name;
        }
        else 
        {
            return 'upload_failed'; 
        }
    }

}

function deleteImage($image, $folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image))
    {
        return true;
    }
    else 
    {
        return false;
    }
}

function upload_user_image($image)
{
    $valid_mime = ['image/jpg', 'image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if(!in_array($img_mime, $valid_mime))
    {
        return 'invalid_format'; //Invalid image format or mime
    }
    else 
    {
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $file_name = "IMG_".rand(10000,99999).".jpeg";
        $folder_path = UPLOAD_IMAGE_PATH."users/".$file_name;

        // image create and compress

        if($extension == "PNG" || $extension == "png")
        {
           $img = imagecreatefrompng($image['tmp_name']);
        }
        else if($extension == "WEBP" || $extension == "webp")
        {
           $img = imagecreatefromwebp($image['tmp_name']);
        }
        else 
        {
           $img = imagecreatefromjpeg($image['tmp_name']);
        }

        if(imagejpeg($img, $folder_path, 75))
        {
            return $file_name;
        }
        else 
        {
            return 'upload_failed'; 
        }
    }

}

?>