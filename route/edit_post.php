<?php

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ไม่พบกิจกรรมที่ต้องการแก้ไข");
}

$id = intval($_POST['id']);
$activity = getActivityById($id);

if (!$activity) {
    die("ไม่พบกิจกรรมนี้ในฐานข้อมูล");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $created_at = $_POST['start_date'];
    $created_at = $_POST['end_date'];
    $image = trim($_POST['image'] ?? '');

    if (empty($name) || empty($description) || empty($created_at) || empty($image)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');</script>";
    } else {
        if (updateActivity($id, $name, $description, $created_at, $created_at, $image)) {
            $_SESSION['success'] = "แก้ไขกิจกรรมสำเร็จ!";
            header("Location: /Choose_activity");
            exit;
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการแก้ไขกิจกรรม";
            header("Location: /activities");
            exit;
        }
    }
}
?>
