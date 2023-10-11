<?php
session_start();
include "connect.php";

if (empty($_SESSION["username"])) {
    header("location: login-form.php");
    exit(); // Terminate the script
}

if ($_SESSION["role"] === "admin") {
    $stmt = $pdo->prepare("SELECT o.ord_id, o.username, o.ord_date, o.status, m.name 
                           FROM orders o 
                           INNER JOIN member m ON o.username = m.username 
                           WHERE m.role = 'user'");
    $stmt->execute();
} else {
    // If the logged-in user is not an admin, show their own orders
    $stmt = $pdo->prepare("SELECT o.ord_id, o.ord_date, o.status 
                           FROM orders o 
                           WHERE o.username = ?");
    $stmt->bindParam(1, $_SESSION["username"]);
    $stmt->execute();
}

// Query to get items left
$stmt_items = $pdo->prepare("SELECT p.pname, i.quantity 
                             FROM product p 
                             LEFT JOIN (
                                SELECT pid, SUM(quantity) AS quantity 
                                FROM item 
                                GROUP BY pid
                             ) i ON p.pid = i.pid");
$stmt_items->execute();
$items_left = [];

while ($row = $stmt_items->fetch()) {
    $items_left[$row["pname"]] = $row["quantity"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?=$_SESSION["fullname"]?> (<?=$_SESSION["role"]?>)</p>

    <?php if ($_SESSION["role"] === "admin") { ?>
        <h2>List of Orders for Users:</h2>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td><?=$row["ord_id"]?></td>
                    <td><?=$row["username"]?></td>
                    <td><?=$row["ord_date"]?></td>
                    <td><?=$row["status"]?></td>
                    <td><?=$row["name"]?></td>
                    <td><a href="order-details.php?ord_id=<?=$row["ord_id"]?>">View Details</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <h2>Your Orders:</h2>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $stmt->fetch()) { ?>
                <tr>
                    <td><?=$row["ord_id"]?></td>
                    <td><?=$row["ord_date"]?></td>
                    <td><?=$row["status"]?></td>
                    <td><a href="order-details.php?ord_id=<?=$row["ord_id"]?>">View Details</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

    <h2>Items Left:</h2>
    <table border="1">
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php foreach ($items_left as $item_name => $quantity) { ?>
            <tr>
                <td><?=$item_name?></td>
                <td><?=$quantity?></td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href='logout.php'>Logout</a>
</body>
</html>
