<?php
include('connect.php');

// Fetch categories from the `categories` table
$sql = "SELECT categories FROM categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row["categories"];
    }
}

// Return categories as JSON
echo json_encode($categories);

$conn->close();
?>
