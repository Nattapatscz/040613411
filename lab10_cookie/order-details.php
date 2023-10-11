<?php
session_start();
include "connect.php";

if (empty($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("location: login-form.php");
    exit(); // Terminate the script
}

// Retrieve the order ID from the URL parameter
if (isset($_GET["ord_id"])) {
    $ord_id = $_GET["ord_id"];

    // Query the database to retrieve order details for the specified order ID
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE ord_id = ?");
    $stmt->bindParam(1, $ord_id);
    $stmt->execute();
    $order = $stmt->fetch();

    if ($order) {
        // Display the order details
        $username = $order["username"];
        $ord_date = $order["ord_date"];
        $status = $order["status"];
        // Add more fields as needed

        // Display the order details
        // You can format and display the details as needed
    } else {
        echo "Order not found.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <p>Order ID: <?=$ord_id?></p>
    <p>Username: <?=$username?></p>
    <p>Order Date: <?=$ord_date?></p>
    <p>Status: <?=$status?></p>
    <!-- Display more order details here -->
    <br>
    <a href='admin-home.php'>Back to Orders</a>
</body>
</html>
