<?php
include('connect.php');
$searchTerm = $_GET['term'] ?? '';

$sql = "SELECT DISTINCT tags FROM articles WHERE  ApproveStatus='Approved'";
$stmt = $conn->query($sql);
$tags = [];
while ($row = $stmt->fetch_assoc()) {
  $titles[] = $row['tags'];
}

echo json_encode($titles);

$conn->close();
?>
