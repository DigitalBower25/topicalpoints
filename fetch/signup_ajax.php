<?php
include 'connect.php';
require('../mailer.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['first_name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $email = $_POST['email'];
    $lastname = $_POST['last_name'];
    $sql ="select * from users where username='".$email."'";
    $result=$conn->query($sql);
    $row = $result->fetch_assoc();
    if(empty($row)){
    $sql = "INSERT INTO users (`username`, `password`, `email`, `firstname`,`lastname`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $email, $password, $email, $firstname,$lastname);
    if ($stmt->execute()) {
        
        $to = $email;
    $subject = "Welcome Aboard, ".htmlspecialchars($firstname)." – Let’s Get Started on TopicalPoints!!";
    $body = '<html>
 <head>
  <title>
   Registration Email
  </title>
  <style>
   body {
            font-family: Arial, sans-serif;
            background-color: #3243232;
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
        }
        .footer {
            background-color: #e0e0e0;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            font-weight:bold;
            color: #666666;
        }
  </style>
 </head>
 <body>
  <div class="email-container">
   <div class="header">
    <img alt="Company Logo" src="https://topicalpoints.com/assets/img/logo.png" />
    <h3>
     TOPICALPOINTS.COM
    </h3>
   </div>
   <div class="content">
    <p>
     Hi '.htmlspecialchars($firstname).', 🎉
    </p>
    <p>
    We’re excited to welcome you to TopicalPoints! Your registration is complete, and you’re now ready to start sharing your content with the world. As a new user, you can publish your first free article right away and reach a wider audience!
    </p>
    <p>
     Here’s what you can do next:
    </p>
    <p>
        1) Publish Your First Free article: <a href="https://topicalpoints.com/signup.php" target="_balnk" style="text-decoration:none;">Submit Here</a><br>
        2) Explore the Dashboard: <a href="https://topicalpoints.com/signin.php" target="_balnk" style="text-decoration:none;">Your Dashboard</a><br>
        3) Need Help?: <a href="https://topicalpoints.com/contact.php" target="_balnk" style="text-decoration:none;">Contact</a>

    </p>
    <p>
     Thanks for joining us, and let us make great things happen together!
    </p>
    <p>
     Cheers,
     <br/>
     The Topical Points Team
    </p>
   </div>
   <div class="footer">
    <p>
     ©topicalpoints.com 2024, All rights Reserved
    </p>
   </div>
  </div>
 </body>
</html>';
    $altBody =''; 
    
     sendMail($to, $subject, $body,$altBody);
 

   
       echo "1";    
    } else {
        echo "Error: " . $stmt->error;
    }
     $stmt->close();
    $conn->close();
}else{
    echo "3"; 
}
   
}
























?>