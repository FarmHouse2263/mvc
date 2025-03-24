<?php
declare(strict_types=1);
// รับข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $org_id = $_POST['user_id'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $end_date = $_POST['end_date'] ?? '';

    // ตรวจสอบค่าจากฟอร์ม
    if (!$org_id || !$title || !$description || !$start_date || !$end_date) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน!";
        exit;
    }

    // โฟลเดอร์เก็บไฟล์
    $uploadDir = 'uploadss/';

    // ตรวจสอบว่าโฟลเดอร์มีอยู่หรือไม่ ถ้าไม่มีก็สร้าง
    if (!createUploadDir($uploadDir)) {
        echo "ไม่สามารถสร้างโฟลเดอร์ได้!<br>";
        exit;
    }

    // ตรวจสอบและอัปโหลดไฟล์
    $uploaded_files = uploadFiles($_FILES['images'], $uploadDir);

    if (empty($uploaded_files)) {
        echo "ไม่พบไฟล์ที่อัปโหลดหรือเกิดข้อผิดพลาดในการอัปโหลดไฟล์<br>";
        exit;
    }

    // รวมชื่อไฟล์ทั้งหมดเป็นสตริงเดียว
    $image_string = implode(',', $uploaded_files);

    // เพิ่มกิจกรรมในฐานข้อมูล
    if (addActivity($title, $description, $start_date, $end_date, $image_string, $org_id)) {
        header('Location: /choose_activity');
        exit();
    } else {
        echo 'เพิ่มกิจกรรมไม่สำเร็จ!<br>';
        echo "ข้อมูลกิจกรรม: $title<br>";
    }
} else {
    echo "ไม่พบการส่งข้อมูล!";
}
?>
