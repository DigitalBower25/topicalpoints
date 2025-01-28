<?php
session_start();
include('../connect.php');

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6; // Number of articles per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$title= $_GET['title']!='' ? "='".$_GET['title']."'" : "!=''";
$offset = ($page - 1) * $limit;

//$user_id = isset($_SESSION['username']) ? $_SESSION['username'] : null;

//if ($user_id) {
// User is logged in, fetch articles specific to the user
$sql = "SELECT * FROM articles  WHERE  ApproveStatus='Pending'  and title ".$title." ORDER BY date
            LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
$articles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blob_content = strip_tags($row['content']);  // Escape HTML characters for safety
        $lines = explode("\n", $blob_content);

        $paragraphs = [];
        foreach ($lines as $line) {
            if (trim($line) !== '') {
                $paragraphs[] = $line; // Store each paragraph
            }
        }

        // Store the article with paragraphs as content
        $articles[] = [
            'id' => $row['id'],
            'title' => htmlspecialchars($row['title']), // Escape title for safety
            'content' => $paragraphs,
            'image' => $row['image'],
            'author' => $row['author'],
            'date' => $row['date'],
            'tags' => $row['tags'],
            'plan' => $row['plan'],
            'price' => $row['price'],
            'approvestatus' => $row['approvestatus'],
            'category' => $row['category']
            
        ];
    }
}


$sql = "SELECT COUNT(*) as total FROM articles WHERE  ApproveStatus='Pending'";


$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'articles' => $articles,
    'total_pages' => $total_pages,
]);
