<?php 
session_start();

$host_name = "localhost";
$user = "root";
$password = "";
$db_name = "hotel";

$conn = mysqli_connect($host_name,$user,$password,$db_name) or die('Database connection failed'.mysqli_connect_error());

function filtration($data)
{
    foreach ($data as $key => $value) 
    {
        $data[$key] = trim($value);
        $data[$key] = stripcslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}


?>