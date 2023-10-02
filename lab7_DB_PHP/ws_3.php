<?php
// เชื่อมต่อฐานข้อมูล
include "connect.php";

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสมาชิกทั้งหมด
$sql = "SELECT * FROM member";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>รายชื่อสมาชิก</title>
</head>
<body>
    <h1>รายชื่อสมาชิก</h1>
    <table border="1">
        <tr>
            <th>ชื่อ</th>
            <th>อีเมล</th>
            <th>ที่อยู่</th>
            <th>รูปภาพโปรไฟล์</th>
        </tr>
        <?php $count = 1; // ตัวแปรสำหรับนับลำดับ ?>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><img src='img_cs/<?= $count ?>.jpg' width='100'></td>
            </tr>
            <?php $count++; // เพิ่มค่าตัวแปรนับลำดับ ?>
        <?php } ?>
    </table>
</body>
</html>
