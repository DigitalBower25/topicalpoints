<?php 

include('mailer.php');

       $to = 'arun1310@gmail.com';
    $subject = "Welcome Aboard, ".htmlspecialchars($firstname)." – Let’s Get Started on TopicalPoints!!";
    $body = '<!DOCTYPE html>
<html>
<head>
    <style>
        /* For any clients that do honor inline styles */
        body {
            background-color: #ffffff !important; /* Force white background */
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#ffffff !important;">
    <!-- Wrapper table with forced inline background color -->
    <table role="presentation" width="100%" style="background-color: #ffffff !important;">
        <tr>
            <td>
                <!-- Main container table with locked background color -->
                <table role="presentation" width="100%" style="background-color: #ffffff !important; padding: 20px;">
                    <tr>
                        <td>
                            <h1 style="color: #333333;">Hello!</h1>
                            <p style="color: #333333;">
                                This email has a fixed background color that won’t adapt in dark mode.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
';
    $altBody =''; 
    
   echo  sendMail($to, $subject, $body,$altBody);






?>