<?php 
require "admin/inc/function.php";

session_start();

unset($_SESSION['LOGIN']);
unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);
unset($_SESSION['USER_EMAIL']);
unset($_SESSION['USER_PHONE']);
unset($_SESSION['USER_PIC']);

redirect("index");
?>