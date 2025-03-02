<?php
// เริ่มต้นเซสชัน
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../databases/activities.php';

$con = getConnection();

if ($con->connect_errno) {
    die("การเชื่อมต่อล้มเหลว: " . $con->connect_error);
}

// ตรวจสอบว่ามีข้อมูลส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // ตรวจสอบค่าที่ส่งมา

    $activity_name = trim($_POST['activity_name'] ?? '');
    $activity_description = trim($_POST['activity_description'] ?? '');
    $activity_image = trim($_POST['activity_image'] ?? '');

    // ตรวจสอบว่าข้อมูลครบถ้วนหรือไม่
    if (empty($activity_name) || empty($activity_description) || empty($activity_image)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header("Location: /activities");
        exit; 
    }

    // ใช้ prepared statement เพื่อเพิ่มข้อมูล
    $stmt = $con->prepare("INSERT INTO activities (name, description, image_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $activity_name, $activity_description, $activity_image);

    if ($stmt->execute()) {
        $_SESSION['success'] = "เพิ่มกิจกรรมสำเร็จ!";
        header("Location: /Choose_activity");
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มกิจกรรม: " . $stmt->error;
        header("Location: /activites");
        exit;
    }

    $stmt->close();
    $con->close();
}
?>
