
<?php
include_once('connect.php');
require('../mailer.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // SQL insert query
    $sql = "INSERT INTO contacts (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        $to=$email;
        $subject="Thank You for Contacting Us!";
        $body='<html><head><title>
   Registration Email
  </title><style>
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
            border: 20px solid #e0e0e0;
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
            
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
             text-align: justify;
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
    <img alt="Company Logo" height="25" src="https://topicalpoints.com/assets/img/logo.png" width="75"/>
    <h1>
     TOPICALPOINTS.COM
    </h1>
    <p>
     Spread your Thought to Universe
    </p>
   </div>
   <div class="content">
    <p>
     Dear '.$name.',
    </p>
        <p>Thank you for contacting the TopicalPoints Team!<br> We’ve successfully received your message, and we’re on it. One of our team members will respond to your inquiry within 2 business days.</p>
        <p>While you wait, feel free to explore more articles. We’re here to help and look forward to assisting you soon!</p>
        
        <p>Best regards,<br/>TopicalPoints Team.</p>
   </div>
   <div class="footer">
    <p>
     ©topicalpoint.com 2024, All rights Reserved
    </p>
   </div>
  </div>
 </body>
</html>';
        sendMail($to, $subject, $body, $altBody = '');
        echo '1';
        //header('Location: ../contact.php');
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}













