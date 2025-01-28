<?php
// upload.php
session_start();
include('connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['croppedImage']) && $_FILES['croppedImage']['error'] == 0) {
        // Define the target directory and file path
        $targetDir = "profiles/";
        $fileName = uniqid() . '.png'; // Use a unique name for the image
        $targetFilePath = $targetDir . $fileName;

        // Create uploads directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES['croppedImage']['tmp_name'], $targetFilePath)) {
            
         
            $userId = $_SESSION['username']; // Adjust based on your authentication method
            $savepath="../fetch/".$targetFilePath;
            // Update the user's profile picture in the database
            if($userId != ''){
            $sql = "UPDATE users SET propic = '".$savepath."' WHERE username = '".$userId."'";
          

            if ($conn->query($sql)) {
                echo json_encode(['success' => true, 'imagePath' => $savepath]);
            } else {
                echo json_encode(['success' => false]);
            }

      
            $conn->close();
            }
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
