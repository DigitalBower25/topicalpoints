<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$servername = "127.0.0.1:3306";
$username = "xxxxxxxx";
$password = "xxxxxxxx";
$dbname = "xxxxxxxxx";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    //echo 'DB Connected Successfully';
}


?>
