<?php
// เชื่อมต่อฐานข้อมูล
include "connect.php";

// ตรวจสอบว่ามีค่าค้นหาที่ส่งมาจากฟอร์มหรือไม่
if (isset($_POST['search'])) {
    $search = $_POST['search'];

    // สร้างคำสั่ง SQL เพื่อค้นหาสมาชิกที่มีชื่อหรืออีเมลที่ตรงกับคำค้นหา
    $sql = "SELECT * FROM member WHERE name LIKE :search OR email LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();
} else {
    // หากไม่มีค่าค้นหาส่งมา ให้แสดงข้อมูลทั้งหมด
    $sql = "SELECT * FROM member";
    $stmt = $pdo->query($sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ผลการค้นหาสมาชิก</title>
</head>
<body>
    <h1>ผลการค้นหาสมาชิก</h1>

    <!-- เพิ่มฟอร์มค้นหา -->
    <form action="ws_4.php" method="POST">
        <label for="search">ค้นหาสมาชิก:</label>
        <input type="text" name="search" id="search">
        <input type="submit" value="ค้นหา">
    </form>

    <table border="1">
        <tr>
            <th>ชื่อ</th>
            <th>อีเมล</th>
            <th>ที่อยู่</th>
            <th>รูปภาพโปรไฟล์</th>
        </tr>
        <?php $count = 1; // ตัวแปรสำหรับนับลำดับ ?>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
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
