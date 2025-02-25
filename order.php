<?php
include('config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $cartItems = json_decode($_POST['cartItems'], true);
        $total_price = 0;

        foreach ($cartItems as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'pending')");
        $stmt->bind_param("id", $user_id, $total_price);
        $stmt->execute();

        $order_id = $stmt->insert_id;

        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $order_id, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();

        echo "Hooray! Your order was placed successfully and will be arriving in just 3 days.";
    } else {
        echo "User not logged in";
    }
}
?>
