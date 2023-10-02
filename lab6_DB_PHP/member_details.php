<?php
// เชื่อมต่อฐานข้อมูล
include "connect.php";

// ตรวจสอบค่า username ที่ส่งมาจาก URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // สร้างคำสั่ง SQL เพื่อดึงข้อมูลสมาชิกที่มี username ตรงกับค่าที่รับมา
    $sql = "SELECT * FROM member WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // ดึงข้อมูลสมาชิก
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($member) {
        // แสดงรายละเอียดของสมาชิก
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>รายละเอียดสมาชิก</title>
        </head>
        <body>
        <?php $count = 1; // ตัวแปรสำหรับนับลำดับ ?>
            <h1>รายละเอียดสมาชิก</h1>
            <p>ชื่อ: <?= $member['name'] ?></p>
            <p>อีเมล: <?= $member['email'] ?></p>
            <p>ที่อยู่: <?= $member['address'] ?></p>
            <!-- รูปภาพโปรไฟล์ -->
            <img src="img_cs/<?= $count ?>.jpg" width="100">
            

        </body>
        </html>
        <?php $count++; // เพิ่มค่าตัวแปรนับลำดับ ?>
        <?php
    } else {
        echo "ไม่พบสมาชิกที่ค้นหา";
    }
} else {
    echo "ไม่พบข้อมูลที่ระบุ";
}
?>
