<?php
// Get basic device details using PHP's $_SERVER superglobal
$userAgent = $_SERVER['HTTP_USER_AGENT'];  // Browser and OS details
$ipAddress = $_SERVER['REMOTE_ADDR'];  // User's IP address

$acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'];  // Language preference

// Optionally, display the information for testing
echo "User Agent: " . $userAgent . "<br>";
echo "IP Address: " . $ipAddress . "<br>";
echo "Language: " . $acceptLanguage . "<br>";
// Check if it's an IPv4 address
if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    echo "User's IPv4 Address: " . $ipAddress;
} else {
    echo "Not an IPv4 address.";
}
?>
