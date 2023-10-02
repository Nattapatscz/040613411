<?php
// 1. ติดต่อฐานข ้อมูล
$pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// 2. ก าหนดรูปแบบค าสง


$stmt = $pdo->prepare("SELECT * FROM product");

// 3. ประมวลผลค า

$stmt->execute();

// 4. วนลูปดึงผลลัพธ์
while ($row = $stmt->fetch()) { // ดึงข ้อมูลทีละแถวเก็บไว ้ใน $row
echo "<pre>";
print_r($row); // ค าสงแสดงค่าในอาร์ ั่ เรย์
echo "</pre>";
}
?>