<?php include "connect.php" ?>
<html>
<head>
    <meta charset="utf-8">
    
</head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
?>
<table border="1">
    <tr>
        <th>รหัสสินค้า</th>
        <th>ชื่อสินค้า</th>
        <th>รายละเอียดสินค้า</th>
        <th>ราคา</th>
    </tr>
    <?php while ($row = $stmt->fetch()) { ?>
        <tr>
            <td><?= $row["pid"] ?></td>
            <td><?= $row["pname"] ?></td>
            <td><?= $row["pdetail"] ?></td>
            <td><?= $row["price"] ?> บาท</td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
