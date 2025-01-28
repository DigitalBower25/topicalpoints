<?php
include 'connect.php';
include('../mailer.php');
session_start();
if (isset($_POST['data'])) {
    $receivedData = $_POST['data'];

    // Remove any added slashes using stripslashes()
    $cleanedData = stripslashes($receivedData);

    // Output or use the cleaned data
    //echo "Cleaned Data: " . htmlspecialchars($cleanedData);
    $dataArray = json_decode($cleanedData, true); // true makes it associative array

    // Check if the JSON decoding was successful
    if ($dataArray !== null) {
        // Access each value from the decoded JSON array

        $firstName = isset($dataArray['given_name']) ? $dataArray['given_name'] : 'N/A';
        $lastName = isset($dataArray['family_name']) ? $dataArray['family_name'] : 'N/A';
        $email = isset($dataArray['email']) ? $dataArray['email'] : 'N/A';
        $propic = isset($dataArray['picture']) ? $dataArray['picture'] : 'N/A';

       echo $fsql = "select * from users where email='".$email."'";
        $stmt = $conn->query($fsql);
        $user = $stmt->fetch_assoc(); // fetch data
        if (empty($user)) {
            $password = password_hash('12345', PASSWORD_BCRYPT);
            $phone = 0;
            $username = $email;
            $sql = "INSERT INTO users (`username`, `password`, `firstname`,`email`,`phonenumber`,`lastname`,`propic`) VALUES (?, ?, ?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $username, $password, $firstName, $email, $phone, $lastName,$propic);

                      if ($stmt->execute()) {
                        $_SESSION['username'] = $username;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastName;
                        $_SESSION['email'] = $email;
                        $_SESSION['phone'] = '';
                        $_SESSION['address'] = '';
                        $_SESSION['usertype'] = 'editor';
                        $_SESSION['propic'] = $propic;
                        
                        
                                
        $to = $email;
    $subject = "Welcome ".htmlspecialchars($firstname)."!";
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
         
                        
                        
                        header('Location:../dashboard');
                        
                        
                } else {
                    echo "Error: " . $stmt->error;
                }

            $stmt->close();
            $conn->close();
        }else{
            $sql = "SELECT * FROM users WHERE username = '" . $email . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $firstlogin = $row['firstlogin'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phonenumber'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['usertype'] = $row['user_type'];
            $_SESSION['propic'] = $row['propic'];
            $_SESSION['countrycode'] = $row['countrycode'];
            if($firstlogin =='1'){
                header('Location:../dashboard');
            }else{
             header('Location:../dashboard');
            }
        }
        
    } else {
        echo "Invalid JSON data received.";
    }
} else {
    header("location:signup.php");
}

?>
