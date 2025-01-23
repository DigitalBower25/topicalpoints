<?php

include('connect.php');


// Get form data from AJAX request
$name = $_POST['name'];
$email = $_POST['email'];
$country_code = $_POST['country_code'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Insert data into the database
$sql = "INSERT INTO callback_request (name, email, country_code, phone, message) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $country_code, $phone, $message);

if ($stmt->execute()) {
    echo "Form submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();













?>