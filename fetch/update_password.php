<?php
error_reporting(0);
header('Content-Type: application/json');
// update_password.php
require('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    require 'connect.php'; // Database connection

    // Validate the token and check if it has expired
     // Validate the token and check if it has expired
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    
    // Use bind_result to fetch the id instead of get_result()
    $stmt->bind_result($userId);
    $userFound = $stmt->fetch();

    if ($userFound) {
        // Close previous statement to avoid "Commands out of sync" error
        $stmt->close();

        // Update the password and clear the reset token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
        $stmt->bind_param("si", $newPassword, $userId);
        $stmt->execute();

        echo json_encode(['message' => "Your password has been reset successfully."]);
    } else {
        echo json_encode(['message' => "Invalid or expired token."]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['message' => "Invalid request."]);
}
?>
