<?php include "connect.php" ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $updateStmt = $pdo->prepare("UPDATE member SET name = ?, address = ?, email = ?, username = ? WHERE user_id = ?");
    $updateStmt->execute([$name, $address, $email, $username, $user_id]);

    header("Location: ws_5.php");
    exit();
} else {
    echo "Invalid request.";
}
?>