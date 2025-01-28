<?php session_start();
include('connect.php');
require('../mailer.php');
$Post_password =$_POST['password']; // Hash the password
$newpassword=password_hash($_POST['cpassword'], PASSWORD_BCRYPT); // Hash the password
$pusername = $_SESSION['username'];

$sql = "SELECT username,password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $pusername);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($username, $password);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
   
    if (password_verify($Post_password, $password)) {
        $to=$pusername;
        $subject='Your Password Has Been Updated Successfully';
        $body='<html>
 <head>
  <title>
   Password Updated
  </title>
  <style>
   body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .email-container {
            background-color: #ffffff;
            width: 600px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #e0e0e0;
            padding: 20px;
            text-align: center;
        }
        .header img {
            width: 50px;
            height: 50px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #666666;
            text-align:justify;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .footer {
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            color: #666666;
        }
  </style>
 </head>
 <body>
  <div class="email-container">
   <div class="header">
    <img alt="Company Logo"  src="https://topicalpoints.com/assets/img/logo.png"/>
    <h1>
     TOPICALPOINTS.COM
    </h1>
   </div>
   <div class="content">
    <p>
     Dear '.$pusername.',<br>
               <p> We wanted to inform you that your password has been updated successfully. If you made this change, no further action is required.</p>
            <p>If you did not request this change, please contact our support team immediately to secure your account.</p>
            <p>For your security, please do not share your password with anyone.</p>
            <p>Thank you for your attention to this matter.</p>
     Cheers,
     <br/>
     The TopicalPoints Team

   </div>
   <div class="footer">
    <p>
     ©topicalpoints.com 2024, All rights Reserved
    </p>
   </div>
  </div>
 </body>
</html>';
        if($newpassword!=''){
        $sql = 'UPDATE users set password=? where username=?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $newpassword, $username);
        if ($stmt->execute()) {
            sendMail($to,$subject.$body,'');
            echo 'success';
        } else {
            echo $stmt->error;
        }
    }else{
        echo 'Old password not matched';
    }
    }else{
        echo 'verify entered both passowrds';
    }
}
