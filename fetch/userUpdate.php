<?php
session_start();
include('connect.php');
$phone = $_POST['phone'];
$address = $_POST['address'];
$countrycode=$_POST['countrycode'];
$firstlogin = '0';
$username = $_SESSION['username'];
$sql = 'UPDATE users set phonenumber=?,countrycode=?,address=?,firstlogin=? where username=?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssss', $phone,$countrycode,$address,$firstlogin,$username);
if($stmt->execute()){
    echo 'success';

}else{
    echo $stmt->error;
}