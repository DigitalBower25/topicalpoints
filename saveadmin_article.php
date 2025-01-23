<?php session_start();
include_once('connect.php');
require 'vendor/autoload.php'; // Include Stripe PHP library
require 'mailer.php';
function generateSlug($string) {
    // Convert to lowercase
    $slug = strtolower($string);
    // Remove any characters that aren’t letters, numbers, spaces, or hyphens
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    // Replace multiple spaces or hyphens with a single hyphen
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    // Trim hyphens from beginning and end
    $slug = trim($slug, '-');
    return $slug;
}
            // Set your secret key (from Stripe Dashboard)
            \Stripe\Stripe::setApiKey('StripeKey'); // Replace with your own Secret Key
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
                /*if (isset($_FILES['imagePreview']) && $_FILES['imagePreview']['error'] === UPLOAD_ERR_OK) {*/ 
                    $token = $_POST['token'];
                    // Directory where the image will be saved
                    $uploadDir = 'uploads/';
            
                    // Ensure the upload directory exists
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    //$file = $_FILES['image'];
                    //$fileExtension = pathinfo($_FILES['imagePreview']['name'], PATHINFO_EXTENSION);
                     // Generate a unique name using uniqid and the current timestamp
                    //$newFileName = uniqid() . '_' . time() . '.' . $fileExtension;
                    //$fileTmpPath = $_FILES['imagePreview']['tmp_name'];
                    //$fileName =$newFileName;
                    //$fileSize = $_FILES['imagePreview']['size'];
                    //$fileType = $_FILES['imagePreview']['type'];
            
                    // Path to save the file
                    
                      $base64data = $_POST['imagePreview'];

                    // Remove the data URL prefix if it's present
                    $base64data = preg_replace('/^data:image\/\w+;base64,/', '', $base64data);
                
                    // Decode the base64 string
                    $imageData = base64_decode($base64data);
                
                    // Set the file path and name
                    $fileName = 'uploads/' . uniqid() . '.png';

    // Save the decoded image to a file
   
                    $destPath =  $fileName;
            
                    // Allowed file types (you can modify based on requirements)
                    $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $editorContent = $_POST['content1'];
                    $cardimage1 = $destPath;
                    $cont_image1 = '';
                    $cont_image2 = '';
                    $title = $_POST['title'];
                    $author = $_POST['author'];
                    $tags = $_POST['tags'];
                    $price = str_replace('$', '', $_POST['price']);
                    $stripe_price = str_replace('$', '', $_POST['price']) . "00";
                    $plan = $_POST['plan'];
                    $duration = $_POST['duration'];
                     $enquiry = $_POST['enquiry'];
                    $category = $_POST['category'];
                    $paymentid = '';
                    $username = $_SESSION['username'];
                    $slug=generateSlug($title);
                    $date = date('Y-m-d');
                    /*if (in_array($fileType, $allowedFileTypes)) { */
                        if (file_put_contents($fileName, $imageData)) {
                            try {
                                // Create a charge: amount is in cents (e.g., $20.00 = 2000)
                                $charge = \Stripe\Charge::create([
                                    'amount' => $stripe_price, // Amount in cents
                                    'currency' => 'usd',
                                    'description' => $title . ' Payment',
                                    'source' => $token,
                                ]);
                                $paymentid = $charge['id'];
                                $ReceiptURL = $charge['receipt_url'];
                                // print_r(array($title, $cardimage1, $cont_image1, $cont_image2, $author, $date, $editorContent, $tags, $price, $plan, $paymentid, $username));
                                $sql = "INSERT INTO articles (`title`, `image`, `author`, `date`, `content`, `tags`, `price`, `plan`, `paymentid`,`ReceiptURL`, `user_id`,`duration`,`category`,`enquiry`,`slugtitle`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('sssssssssssssss', $title, $cardimage1,$author, $date, $editorContent, $tags, $price, $plan, $paymentid, $ReceiptURL, $username,$duration,$category,$enquiry,$slug);
                            } catch (\Stripe\Exception\CardException $e) {
                                // Handle the error
                                http_response_code(500);
                                echo 'Error: ' . $e->getError()->message;
                            }
                            if ($stmt->execute()) {
                                
                                $to=$username;
                                $subject='Your Purchase Confirmation – Article Under Review';
                                $altbody='';
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
   </div>
   <div class="content">
    <p>
     Hi '.$author.',
    </p>
  
        <p>Thank you for your choose Us ! Your article has been submitted and is currently under review. Our team will evaluate the article for compliance with our guidelines. You can expect a confirmation of approval within 24 to 48 hours.</p>
        <p>Here are the details of your purchase:</p>
        <p>Plan Type: '.$plan.'<br>
         Plan Duration: '.$duration.' Days</p>
         <p>Your receipt is available for download in your account. Simply <a href="https://topicalpoints.com/signin.php" style="text-decoration:none;" target="_blank">log-in</a> to access it at any time.
</p>
        <p>If you have any questions in the meantime, don’t hesitate to reach out.
</p>
        <p>Best regards,<br/>Topicalpoints Team.</p>
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
                            } else {
                                echo "0" . $stmt->error;
                            }
            
                            $stmt->close();
                        } else {
                            echo 'Error moving the uploaded file.';
                        }
                    /*} else {
                        echo 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
                    }*/
                /*} else {
                    echo 'Error in file upload.';
                }*/
            }
