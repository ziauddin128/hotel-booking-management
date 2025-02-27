<?php 


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


?>