<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['credential'];

    // Verify the token using Google's tokeninfo endpoint
    $url = 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $token;
    $response = file_get_contents($url);
    $data = json_decode($response);
    
    if (isset($data->email)) {
        // Successful authentication
      echo json_encode($data);
    } else {
        echo 'Invalid ID token.';
    }
}
?>
