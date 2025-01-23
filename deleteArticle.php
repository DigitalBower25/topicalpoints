<?php 

include('connect.php');



if (isset($_POST)) {
    $idToDelete = $_POST['term'];

    // Step 2: Delete the article with the duplicate title
    $deleteQuery = "DELETE FROM articles WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $idToDelete);

    if ($stmt->execute()) {
        echo "1"; // Success response
    } else {
        echo "Error deleting article: " . $stmt->error;
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>