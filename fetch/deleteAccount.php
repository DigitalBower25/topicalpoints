<?php 
session_start();
include('connect.php');
$status=$_POST['data'];
if($status=='delete'){
    $uname=$_SESSION['username'];
    $sql="DELETE FROM users where username='".$uname."'";
     $sql1="DELETE FROM articles where user_id='".$uname."'";
     if($conn->query($sql) || $conn->query($sql2)){
         session_destroy();
         $_SESSION=[];
         echo 'success';
     }
}




















?>