<?php 
session_start();
include('../connect.php');

if (isset($_POST['categories'])) {
    $categories = $_POST['categories']; // This will be an array
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3; // Number of articles per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$user_id = isset($_SESSION['username']) ? $_SESSION['username'] : null;
// Base query
$query = "SELECT * FROM `articles` WHERE ";

// Check if categories are provided
if (!empty($categories)) {
    // Generate placeholders for each category in the array
    $placeholders = implode("' OR category='", $categories);
    $query .= "category='" . $placeholders . "' ORDER BY category  LIMIT $limit OFFSET $offset";
} else {
    $query .= "1"; // This will select all if no category is provided
}
//echo $query;
$result = $conn->query($query);
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
            'image'=>$row['image'],
            'author'=>$row['author'],
            'date'=>$row['date'],
            'tags'=>$row['tags'],
            'plan'=>$row['plan'],
            'price'=>$row['price'],
            'duration'=>$row['duration'],
            'category'=>$row['category'],
        ];
    }
}


$sql1 = "SELECT COUNT(*) as total FROM articles WHERE ";
// Check if categories are provided
if (!empty($categories)) {
    // Generate placeholders for each category in the array
    $placeholders = implode("' OR category='", $categories);
    $sql1 .= " category='" . $placeholders . "'  ORDER BY category";
} else {
    $sql1 .= "1"; // This will select all if no category is provided
}

//echo $sql1;
$result = $conn->query($sql1);
$row = $result->fetch_assoc();
$total = $row['total'];
$total_pages = ceil($total / $limit);

$conn->close();

header('Content-Type: application/json');
echo json_encode([
    'articles' => $articles,
    'total_pages' => $total_pages,
]);






}











?>