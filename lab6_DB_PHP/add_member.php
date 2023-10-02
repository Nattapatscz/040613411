<?php
// เชื่อมต่อฐานข้อมูล
include "connect.php";

// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลสมาชิกใหม่
    $sql = "INSERT INTO member (name, email, address, username, password) VALUES (:name, :email, :address, :username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    // ทำการเพิ่มข้อมูลลงในฐานข้อมูล
    if ($stmt->execute()) {
        echo "เพิ่มสมาชิกใหม่เรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มสมาชิกใหม่";
    }
}
?>
