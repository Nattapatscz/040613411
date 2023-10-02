<?php include "connect.php" ?>

<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php $count= 1?>
    <?php
    // Display existing users
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) :
    ?>
        <div>
            ชื่อสมาชิก: <?= $row["name"] ?><br>
            ที่อยู่: <?= $row["address"] ?><br>
            อีเมล์: <?= $row["email"] ?><br>
            <img src="img_cs/<?= $count ?>.jpg" width="100"><br>
            <hr>
        </div>
        <?php $count++ ?>
    <?php endwhile; ?>

    <h2>Add User</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="name">ชื่อสมาชิก:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="address">ที่อยู่:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="email">อีเมล์:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="profile_image">รูปภาพโปรไฟล์:</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*" required><br>

        <button type="submit" name="add_user">Add User</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $username = $_POST['username'];

        // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพ
        if (isset($_FILES['profile_image'])) {
            $file_name = $_FILES['profile_image']['name'];
            $file_tmp = $_FILES['profile_image']['tmp_name'];

            // ตรวจสอบว่าไฟล์ที่อัปโหลดเป็นไฟล์รูปภาพ
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($file_ext, $allowed_extensions)) {
                // สร้างชื่อไฟล์ใหม่เพื่อป้องกันชื่อซ้ำ
                $new_file_name = $username . '.' . $file_ext;

                // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่เหมาะสม
                $upload_dir = 'img/';
                move_uploaded_file($file_tmp, $upload_dir . $new_file_name);
            } else {
                echo "Error: ไฟล์ที่อัปโหลดไม่ใช่ไฟล์รูปภาพที่รองรับ (jpg, jpeg, png, gif)";
            }
        }

        // ตรวจสอบว่าชื่อผู้ใช้งานซ้ำหรือไม่
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM member WHERE username = ?");
        $checkStmt->execute([$username]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            echo "Error: Username already exists.";
        } else {
            // เพิ่มผู้ใช้ใหม่ลงในฐานข้อมูล
            $insertStmt = $pdo->prepare("INSERT INTO member (name, address, email, username) VALUES (?, ?, ?, ?)");
            $insertStmt->execute([$name, $address, $email, $username]);
        }
    }

    ?>
</body>

</html>