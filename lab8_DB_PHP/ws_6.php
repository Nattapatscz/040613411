<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php $count = 1; // ตัวแปรสำหรับนับลำดับ ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
        // Process delete request
        $user_id = $_POST['user_id'];
        $deleteStmt = $pdo->prepare("DELETE FROM member WHERE username = ?");
        $deleteStmt->execute([$user_id]);
    }

    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()):
    ?>
        <div>
            ชื่อสมาชิก: <?= $row["name"] ?><br>
            ที่อยู่: <?= $row["address"] ?><br>
            อีเมล์: <?= $row["email"] ?><br>
            <img src="img_cs/<?= $count ?>.jpg" width="100"><br>
            <form method="post" action="">
                <input type="hidden" name="user_id" value="<?= $row["username"] ?>">
                <button type="submit" name="delete_user">Delete</button>
            </form>
            <hr>
        </div>
        <?php $count++; // ตัวแปรสำหรับนับลำดับ ?>
    <?php endwhile; ?>
</body>

</html>
