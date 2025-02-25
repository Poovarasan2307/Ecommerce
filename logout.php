<?php
include('config.php');
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE users SET status = 'inactive' WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}

session_unset();
session_destroy();

echo "<script>alert('Logout successful.'); window.location.href = 'index.php';</script>";
?>
