<?php 
include_once('connect.php');

$id=$_GET['id'];
$sql = "SELECT * FROM comments  WHERE article_id='".$id."'";

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
    'data' => $articles
]);

















?>