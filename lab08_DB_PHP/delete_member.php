<?php
// เชื่อมต่อฐานข้อมูล
include "connect.php";

// ตรวจสอบค่า username ที่ส่งมาจาก URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // สร้างคำสั่ง SQL เพื่อลบข้อมูลสมาชิกที่มี username ตรงกับค่าที่รับมา
    $sql = "DELETE FROM member WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    
    // ลบข้อมูล
    if ($stmt->execute()) {
        echo "ลบข้อมูลสมาชิก $username เรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล";
    }
} else {
    echo "ไม่พบข้อมูลที่ระบุ";
}
?>
