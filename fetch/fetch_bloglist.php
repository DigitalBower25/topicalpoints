<?php
session_start();
include('../connect.php');

$title= $_GET['title']!='' ? "='".$_GET['title']."'" : "!=''";
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3; // Number of articles per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$categories = $_GET['categories'];





 $sql = "SELECT  * FROM articles where approvestatus='Approved'";

if ($title!='') {
    
    $sql .= " AND title ".$title;
}

if (!empty($categories)) {
    // Generate placeholders for each category in the array
    $placeholders = implode("' OR category='", $categories);
    $sql .= " AND category='" . $placeholders . "' ";
} 





$sql.=" AND  DATEDIFF(CURDATE(), `createdon`) < `duration`  ORDER BY  `category`  DESC LIMIT $limit OFFSET $offset";
//echo $sql;
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
            'image'=>$row['image'],
            'author'=>$row['author'],
            'date'=>$row['date'],
            'tags'=>$row['tags'],
            'plan'=>$row['plan'],
            'price'=>$row['price'],
            'approvestatus'=>$row['approvestatus'],
            'duration'=>$row['duration'],
            'category'=>$row['category'],
             'slug'=>$row['slugtitle']
        ];
    }
}


$sql1 = "SELECT COUNT(*) as total FROM articles  where approvestatus='Approved'";


if ($title!='') {
    //$sql1 .= "  AND user_id = '".$user_id."'";
    $sql1 .= " AND title ".$title;
}

if (!empty($categories)) {
    // Generate placeholders for each category in the array
    $placeholders = implode("' OR category='", $categories);
    $sql1 .= " AND category='" . $placeholders . "' ";
} 
$sql1.=" AND  DATEDIFF(CURDATE(), `createdon`) < `duration`  ORDER BY  `category`";
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


























?>