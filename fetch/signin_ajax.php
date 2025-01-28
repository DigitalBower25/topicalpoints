<?php
include('connect.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $username = $_POST['username'];
    $Post_password = $_POST['password'];
   

    $sql = "SELECT username,password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($Post_password, $password)) {
            

            $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $firstlogin = $row['firstlogin'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phonenumber'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['usertype'] = $row['user_type'];
             $_SESSION['propic'] = $row['propic'];
             $_SESSION['countrycode'] = $row['countrycode'];
            if($row['user_type']=='editor'){
                echo  $login = ($firstlogin == 1) ? '2' : '1';
            }else{
                echo '3';
            }
           

        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
