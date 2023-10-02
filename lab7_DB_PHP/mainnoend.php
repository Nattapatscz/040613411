<?php include "connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
while ($row = $stmt->fetch()) {
?>
รหัสสนค ้า ิ : <?=$row ["pid"]?><br>
ชอ
ื่
สนค ้า ิ : <?=$row ["pname"]?><br>
รายละเอียดสนค ้า ิ : <?=$row ["pdetail"]?><br>
ราคา: <?=$row ["price"]?> บาท<br><hr>
<?php } ?>
</body>
</html>