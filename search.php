<?php
include('connect.php');
$searchTerm = $_GET['term'] ?? '';

$sql = "SELECT title FROM articles WHERE title LIKE ? and ApproveStatus='Approved'";
$stmt = $conn->prepare($sql);
$likeTerm = "%$searchTerm%";
$stmt->bind_param("s", $likeTerm);
$stmt->execute();
$result = $stmt->get_result();

$titles = [];
while ($row = $result->fetch_assoc()) {
  $titles[] = $row['title'];
}

echo json_encode($titles);

$conn->close();
?>
