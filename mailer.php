<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendMail($to, $subject, $body, $altBody = '') {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = ' smtp.hostinger.com';  // Set your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = '';  // SMTP username
        $mail->Password   = '';  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Encryption
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('', '');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody;

        if($mail->send()){
        return true;    
        }
        
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
