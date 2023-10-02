<?php include "connect.php"; ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
while ($row = $stmt->fetch()) {
echo "<pre>";
print_r($row);
echo "</pre>";
}
?>
</body>
</html>