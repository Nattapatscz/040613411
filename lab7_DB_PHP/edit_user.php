<?php
include "connect.php";

// Check if the user_id parameter is provided in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM member WHERE user_id = :user_id");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($row = $stmt->fetch()):
?>

<html>
<head>
<meta charset="utf-8">
</head>
    <body>
        <h2>Edit User</h2>
        <form method="post" 
            action="update_user.php">

            <input type="hidden" 
            name="user_id" value="<?= $row['user_id'] ?>">

            <label for="name">ชื่อสมาชิก:</label>
            <input type="text" id="name" 
            name="name" value="<?= $row['name'] ?>" required><br>

            <label for="address">ที่อยู่:</label>
            <input type="text" id="address" 
            name="address" value="<?= $row['address'] ?>" required><br>

            <label for="email">อีเมล์:</label>
            <input type="email" id="email" 
            name="email" value="<?= $row['email'] ?>" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" 
            name="username" value="<?= $row['username'] ?>" required><br>

            <button type="submit" name="update_user">Update User</button>
        </form>
    </body>
</html>

        <?php
            else:
                echo "User not found.";
            endif;
        } else {
            echo "User ID is not provided.";
        }
        ?>