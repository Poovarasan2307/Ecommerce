<?php
include('config.php');

// Insert new category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        echo "New category added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
