<?php session_start();
include('connect.php');
require('../mailer.php');
$username=$_SESSION['username'];
$sql = "SELECT firstarticle FROM users WHERE username = '" . $username . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $firstarticle = $row['firstarticle'];
           
if( $firstarticle == '1'){
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                /*if (isset($_FILES['imagePreview']) && $_FILES['imagePreview']['error'] === UPLOAD_ERR_OK) {*/
                    //$token = $_POST['token'];
                    // Directory where the image will be saved
                    $uploadDir = 'uploads/';
            
                      $base64data = $_POST['imagePreview'];

    // Remove the data URL prefix if it's present
    $base64data = preg_replace('/^data:image\/\w+;base64,/', '', $base64data);

    // Decode the base64 string
    $imageData = base64_decode($base64data);

    // Set the file path and name
    $fileName = 'uploads/' . uniqid() . '.png';

    // Save the decoded image to a file
    if (file_put_contents($fileName, $imageData)) {
                    
            
                    // Path to save the file
                    $destPath = 'fetch/'.$fileName;
            
                    // Allowed file types (you can modify based on requirements)
                    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $editorContent = $_POST['content1'];
                    $cardimage1 = $destPath;
                    $title = $_POST['title'];
                    $author = $_POST['author'];
                    $tags = $_POST['tags'];
                    $price='0';
                    $plan='free';
                    $duration='7';
                     $catogory=$_POST['category'];
                    $date = date('Y-m-d');
                    /*if (in_array($fileType, $allowedFileTypes)) {*/
                        
                         if (file_put_contents($fileName, $imageData)) {
                           
                           
                                // print_r(array($title, $cardimage1, $cont_image1, $cont_image2, $author, $date, $editorContent, $tags, $price, $plan, $paymentid, $username));
                                $sql = "INSERT INTO articles (`title`, `image`, `author`, `date`, `content`, `tags`, `user_id`, `price`, `plan`,`duration`,`category`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('sssssssssss', $title, $cardimage1, $author, $date, $editorContent, $tags, $username, $price, $plan,$duration,$catogory);
                           
                            if ($stmt->execute()) {
                                $sql="UPDATE users SET firstarticle=0 WHERE username='".$username."'";
                                $result = $conn->query($sql);
                                if($result){
                                    
                                $to = $username;
                                $subject = 'Free Article Posted Successfully';
                                $body = '<html><head><title>
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
     Hi '.$author.',
    </p>
    <h1>'.$title.'</h1>
        <p>Thank you for your choose Us ! Your article has been submitted and is currently under review. Our team will evaluate the article for compliance with our guidelines. You can expect a confirmation of approval within 24 to 48 hours.</p>
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
                                //$altBody = 'This is an email from Page 1 (text-only).';
                                
                                if(sendMail($to, $subject, $body, $altBody="")){    
                                
                                    echo '1';    
                                }                                        
                                    
                                
                                }
                            } else {
                                echo "0" . $stmt->error;
                            }
            
                            $stmt->close();
                        } else {
                            echo 'Error moving the uploaded file.';
                        }
                   /* } else {
                        echo 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
                    }*/
                /*} else {
                    echo 'Error in file upload.';
                }*/
            }
    
}



}






?>