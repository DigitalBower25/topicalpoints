
<?php
session_start();
include('../connect.php');




$sql="SELECT * FROM ( SELECT * FROM articles WHERE  image!='' ORDER BY id DESC LIMIT 5 )Var1  ORDER BY id ASC";
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
             'slug'=>$row['slugtitle']
            
            
        ];
    }
}

header('Content-Type: application/json');
echo json_encode([
    'articles' => $articles,
]);
