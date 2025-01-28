<?php
session_start();

include('../connect.php');
require('../mailer.php');
if(isset($_POST)){
    $status=$_POST['status'];
    $id=$_POST['id'];

    $sql= "UPDATE articles set Approvestatus=? WHERE id=?";
    $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $status, $id);
        if ($stmt->execute()) {
            
            $sql='SELECT user_id,title,author FROM articles WHERE id=?';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $title = $row['title'];
             $author = $row['author'];
             $touser = $row['user_id'];
            
             if($status=='Approved'){           
                        $to = $touser;
                        $subject = 'Your Articles Have Been Approved!';
                        $body = '<html>
             <head>
              <title>
               Registration Email
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
                        text-align:justify;
                    }
                    .footer {
                        background-color: #e0e0e0;
                        padding: 10px;
                        text-align: center;
                        font-size: 16px;
                        color: #666666;
                    }
              </style>
             </head>
             <body>
              <div class="email-container">
               <div class="header">
                <img alt="Company Logo" height="50" src="https://topicalpoints.com/assets/img/logo.png" width="50"/>
                <h1>
                 TOPICALPOINTS.COM
                </h1>
                
               </div>
               <div class="content">
                <p>
                 Dear '.$author.',
                </p>
                   <p> We are pleased to inform you that your submitted articles have been approved for publication. Thank you for your hard work and contribution.</p>
                    
                    <p>You can view your articles on our platform here: <a href="https://topicalpoints.com/singlePost?title='.$id.'">'.$title.'</a>. </p>
                    
                    <p>We appreciate your dedication and look forward to more insightful content from you in the future.</p>
                    
                    <p>If you have any questions or need further assistance, feel free to reach out to us.</p>
                    
                    <p>Thank you again for being a valued contributor.</p>
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
            
                        
             }else if($status=='Declined'){
                 $to = $touser;
                        $subject = 'Important: Your Article Submission';
                        $body = '<html>
             <head>
              <title>
               Registration Email
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
                        text-align:justify;
                    }
                    .footer {
                        background-color: #e0e0e0;
                        padding: 10px;
                        text-align: center;
                        font-size: 16px;
                        color: #666666;
                    }
              </style>
             </head>
             <body>
              <div class="email-container">
               <div class="header">
                <img alt="Company Logo" height="50" src="https://topicalpoints.com/assets/img/logo.png" width="50"/>
                <h1>
                 TOPICALPOINTS.COM
                </h1>
                
               </div>
               <div class="content">
                <p>
                 Dear '.$author.',
                </p>
                   <p> Thank you for submitting your article to TopicalPoints. After careful review, we regret to inform you that your article, titled "'.$title.'", does not meet our publishing standards and has been rejected.</p>
                    
                    <p>As a result, a refund will be processed within 7 working days to your original payment method. Please keep an eye on your account for the transaction. </p>
                    
                    <p>If you need any further clarification or assistance, feel free to reach out to our support team.</p>
                    
                    <p>We appreciate your understanding and look forward to your next submission.</p>
                <p>
                 Best regards,
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
             }   
             
             if(sendMail($to, $subject, $body,'')){
                echo 'success';    
            }  
          
        } else {
            echo $stmt->error;
        }

}




