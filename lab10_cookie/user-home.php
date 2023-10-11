
<?php
ini_set('display_errors', 1);

session_start();
include "connect.php";

// Check if the user is logged in
if (empty($_SESSION["username"])) {
    header("location: login-form.php");
}

// Fetch the user's orders and products
$stmt = $pdo->prepare("SELECT o.ord_id, o.ord_date, o.status, p.pname, p.price, i.quantity
                      FROM orders o
                      JOIN item i ON o.ord_id = i.ord_id
                      JOIN product p ON i.pid = p.pid
                      WHERE o.username = ?");
$stmt->bindParam(1, $_SESSION["username"]);
$stmt->execute();

echo "<html>";
echo "<body>";
echo "<h1>สวัสดี " . $_SESSION["fullname"] . "</h1>";

while ($row = $stmt->fetch()) {
    echo "<h2>Order ID: " . $row["ord_id"] . "</h2>";
    echo "Order Date: " . $row["ord_date"] . "<br>";
    echo "Status: " . $row["status"] . "<br>";

    echo "<ul>";
    echo "<li>ชื่อสินค้า: " . $row["pname"] . "</li>";
    echo "<li>ราคา: " . $row["price"] . " บาท</li>";
    echo "<li>จำนวน: " . $row["quantity"] . "</li>";
    echo "</ul>";
}

echo "หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>";
echo "</body>";
echo "</html>";
?>
