<?php
include "connect.php";
session_start();

$stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
$stmt->bindParam(1, $_POST["username"]);
$stmt->bindParam(2, $_POST["password"]);
$stmt->execute();
$row = $stmt->fetch();

// Check if the login is successful
if (!empty($row)) { 
    // Set user-related session variables
    $_SESSION["fullname"] = $row["name"];   
    $_SESSION["username"] = $row["username"];
    
    if ($row["role"] === "admin") {
        $_SESSION["role"] = "admin"; 
    } else {
        $_SESSION["role"] = "user"; 
    }

    if ($_SESSION["role"] === "admin") {
        header("Location: admin-home.php");
    } else {
        header("Location: user-home.php");
    }
    exit(); 
} else {
    echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
    echo "<a href='login-form.php'>เข้าสู่ระบบอีกครั้ง</a>"; 
}
?>
