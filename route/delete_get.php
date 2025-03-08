<?php
require_once __DIR__ . '/../databases/activities.php';

// เปิดการแสดงข้อผิดพลาด
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ทดสอบว่าหน้านี้ทำงานหรือไม่
echo "ไฟล์นี้ทำงานได้!<br>";

// ตรวจสอบว่ามี 'id' ที่ส่งมาหรือไม่
if (!isset($_GET['id'])) {
    die("ไม่พบกิจกรรมที่ต้องการลบ");
}

$id = intval($_GET['id']); // ป้องกัน SQL Injection

// เชื่อมต่อฐานข้อมูล
$conn = getConnection();


// ตรวจสอบก่อนว่ากิจกรรมนี้มีอยู่จริงหรือไม่
$sql = "SELECT * FROM activities WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("ไม่พบกิจกรรมที่ต้องการลบ");
}

// ดึงข้อมูลกิจกรรม
$activity = $result->fetch_assoc();
$image_url = $activity['image_url'] ?? '';

// ลบกิจกรรมจากฐานข้อมูล
$sql = "DELETE FROM activities WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // ถ้ามีรูปภาพให้ลบไฟล์
    if (!empty($image_url) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_url)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $image_url);
    }

    // รีไดเร็กต์กลับไปที่ Choose_activity_get.php
    header("Location: /route/Choose_activity_get.php?deleted=success");
    exit;
} else {
    echo "<script>
            alert('ไม่สามารถลบกิจกรรมได้');
            window.location.href = '/route/Choose_activity_get.php';
          </script>";
}
?>
