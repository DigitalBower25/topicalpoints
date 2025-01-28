<?php
// send_reset_link.php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    require '../connect.php'; // Database connection
     require '../mailer.php'; // Database connection

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $stmt->close();
        // Generate a unique token
        $token = bin2hex(random_bytes(10));

        // Store the token in the database with an expiry date (e.g., 1 hour)
        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE email = ?");
        $stmt->execute([$token, date("Y-m-d H:i:s", strtotime('+1 hour')), $email]);

        // Send the reset link to the user's email
        $resetLink = "https://topicalpoints.com/reset_password?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: " . $resetLink;
        $headers = "From: noreply@tropicalpoints.com";

        if (sendMail($email, $subject, $message, $headers))  {
            echo json_encode(['message' => "Password reset link has been sent to your email."]);
        } else {
            echo json_encode(['message' => "Failed to send email."]);
        }
    } else {
        echo json_encode(['message' => "Email not found."]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['message' => "Invalid request."]);
}

?>
