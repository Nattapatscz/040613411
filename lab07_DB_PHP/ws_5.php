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
            <th>link</th>
        </tr>
        
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td>
                        <!-- เพิ่มลิงก์ไปยังหน้าแสดงรายละเอียดสมาชิก -->
                        <a href="member_details.php?username=<?= $row['username'] ?>">ดูรายละเอียด</a>
                    </td>
                </tr>
                
            <?php } ?>

    </table>
</body>
</html>
