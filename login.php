<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Update user status to 'active' upon successful login
            if ($user['status'] == 'inactive') {
                $update_stmt = $conn->prepare("UPDATE users SET status = 'active' WHERE email = ?");
                $update_stmt->bind_param("s", $email);
                $update_stmt->execute();
                $update_stmt->close();
            }
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            echo "<script>alert('login successfully.'); window.location.href = 'add_to_cart.php';</script>";
            // Redirect to a protected page
            // header("Location: index.php");
        } else {
            echo "<script>alert('Invalid password.'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with that email.'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
