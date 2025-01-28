<?php
include_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Remember to hash the password before storing in production
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $firstlogin = '0';
    $firstarticle ='0';
    $user_type = "admin";
    $address = $_POST['address'];

    // SQL insert query
    $sql = "INSERT INTO users (username, password, email, phonenumber, firstname, lastname, firstlogin, firstarticle, user_type, address)
            VALUES ('$username', '$password', '$email', '$phonenumber', '$firstname', '$lastname', '$firstlogin', '$firstarticle', '$user_type', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully";
        header('Location:/');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
