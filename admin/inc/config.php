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
        if (is_array($value)) 
        {
            $data[$key] = filtration($value);
        }
        else 
        {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
    
            $data[$key] = $value;
        }
       
    }
    return $data;
}

function selectAll($table)
{
    $conn = $GLOBALS['conn'];
    $res = mysqli_query($conn, "SELECT * FROM `$table`");
    return $res;
}

function select($sql, $data_types, $values)
{
    $conn = $GLOBALS['conn'];

    $res = $conn->prepare($sql);
    $res->bind_param($data_types, ...$values);
    if($res->execute())
    {
        $result = $res->get_result();
        $res->close();
        return $result;
    }
    else 
    {
        $error = "Query execution failed - Select";
        $res->close();
        return $error;
    }
}

function update($sql, $data_types, $values)
{
    $conn = $GLOBALS['conn'];

    $res = $conn->prepare($sql);
    $res->bind_param($data_types, ...$values);
    if($res->execute())
    {
        $result = $conn->affected_rows;

        $res->close();
        return $result;
    }
    else 
    {
        $error = "Query execution failed - Update";
        $res->close();
        return $error;
    }
}

function insert($sql, $data_types, $values)
{
    $conn = $GLOBALS['conn'];

    $res = $conn->prepare($sql);
    $res->bind_param($data_types, ...$values);
    if($res->execute())
    {
        $result = $conn->affected_rows;

        $res->close();
        return $result;
    }
    else 
    {
        $error = "Query execution failed - Insert";
        $res->close();
        return $error;
    }
}

function delete($sql, $data_types, $values)
{
    $conn = $GLOBALS['conn'];

    $res = $conn->prepare($sql);
    $res->bind_param($data_types, ...$values);
    if($res->execute())
    {
        $result = $conn->affected_rows;

        $res->close();
        return $result;
    }
    else 
    {
        $error = "Query execution failed - Delete";
        $res->close();
        return $error;
    }
}

?>