<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $status = 'inactive'; // Default status
    $address = $_POST['address']; // Get the address from the form

    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, status, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstname, $lastname, $email, $password, $status, $address);

    if ($stmt->execute()) {
        header("Location: thank_you.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
