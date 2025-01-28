<?php
session_start();
include('../connect.php');

$title = isset($_GET['title']) ? $_GET['title'] : ''; 
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    // User is logged in, fetch articles specific to the user
   $sql = "SELECT * FROM articles WHERE ( id='".$title."' or title='".$title."') limit 1";
} else {
    // No user logged in, fetch random articles
    $sql = "SELECT * FROM articles  WHERE  (id='".$title."' or title='".$title."') limit 1";
}
$result = $conn->query($sql);
$articles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // Store the article with paragraphs as content
        $articles[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'articles' => $articles
]);


























?>