<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php $count = 1; // ตัวแปรสำหรับนับลำดับ ?>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()):
        ?>
        <div>

            ชื่อสมาชิก:
            <?= $row["name"] ?><br>

            ที่อยู่:
            <?= $row["address"] ?><br>

            อีเมล์:
            <?= $row["email"] ?><br>

            <img src="img_cs/<?= $count ?>.jpg" width="100"><br>
            <a href="edit_user.php?user_id=<?= $row["user_id"] ?>">Edit User</a><br>
            <hr>
        </div>
    <?php $count++; // ตัวแปรสำหรับนับลำดับ ?>    
    <?php endwhile; ?>
</body>

</html>
