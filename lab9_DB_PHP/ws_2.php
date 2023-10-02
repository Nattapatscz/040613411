<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
    ?>
        <?= $row["name"] ?><br>
         <?= $row["address"] ?><br>
        <?= $row["email"] ?><br>
         
        <hr>
    <?php } ?>
</body>

</html>