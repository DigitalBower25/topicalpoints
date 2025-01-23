<?php
include('connect.php');
// Insert data into `categories` table
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $conn->real_escape_string($_POST['category_name']);
    
    $sql = "INSERT INTO `categories` (`categories`) VALUES ('$category_name')";

    if ($conn->query($sql) === TRUE) {
       header('location:Addcategories');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
