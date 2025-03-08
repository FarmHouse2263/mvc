<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
echo "ไฟล์นี้ทำงานได้!<br>";

if (!isset($_GET['id'])) {
    die("ไม่พบกิจกรรมที่ต้องการลบ");
}

$id = intval($_GET['id']);
$conn = getConnection();

$sql = "SELECT * FROM activity WHERE aid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("ไม่พบกิจกรรมที่ต้องการลบ");
}

$activity = $result->fetch_assoc();
$image_url = $activity['image_url'] ?? '';

// ลบกิจกรรมจากฐานข้อมูล
$sql = "DELETE FROM activity WHERE aid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // ถ้ามีรูปภาพให้ลบไฟล์
    if (!empty($image_url) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_url)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $image_url);
    }
    echo 'ทำงานได้';
    header("Location: /Choose_activity");
    exit;
} else {
    echo "<script>
            alert('ไม่สามารถลบกิจกรรมได้');
            window.location.href = '/Choose_activity';
          </script>";
}
?>
