<?php
require_once __DIR__ . '/../databases/activities.php';

// ตรวจสอบว่ามี ID ถูกส่งมาหรือไม่
if (!isset($_GET['id'])) {
    die("ไม่พบกิจกรรมที่ต้องการแก้ไข");
}

$id = intval($_GET['id']); // ป้องกัน SQL Injection
$sql = "SELECT * FROM activities WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$activity = $result->fetch_assoc();

if (!$activity) {
    die("ไม่พบกิจกรรม");
}

// เมื่อกดปุ่มบันทึก
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $created_at = $_POST['created_at'];

    // ตรวจสอบว่าค่าที่ส่งมาไม่ว่าง
    if (empty($name) || empty($description) || empty($created_at)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');</script>";
    } else {
        $sql = "UPDATE activities SET name=?, description=?, created_at=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $description, $created_at, $id);

        if ($stmt->execute()) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let toastEl = new bootstrap.Toast(document.getElementById('successToast'));
                        toastEl.show();
                        setTimeout(() => { window.location.href='Choose_activity_get.php'; }, 2000);
                    });
                  </script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล');</script>";
        }
    }
}
