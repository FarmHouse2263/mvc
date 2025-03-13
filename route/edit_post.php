<?php
// ตรวจสอบการส่งข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // รับค่าลิ้งรูปภาพที่ส่งมาเป็น array
    $images = $_POST['images'] ?? [];
    
    // ตรวจสอบว่ามีภาพอย่างน้อย 1 รูป
    if (empty($images) || !is_array($images) || empty($images[0])) {
        $_SESSION['error'] = "กรุณาระบุลิงก์รูปภาพอย่างน้อย 1 รูป";
        header("Location: /edit?id=" . $_POST['id']); // กลับไปที่หน้า edit
        exit;
    }
    
    // แปลง array ของลิงก์รูปภาพเป็น string คั่นด้วย | เพื่อเก็บในฐานข้อมูล
    $image_links = implode('|', array_filter($images));
    
    // ตรวจสอบข้อมูลที่ได้รับ
    if (empty($name) || empty($description) || empty($start_date) || empty($end_date) || empty($image_links)) {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
        header("Location: /edit?id=" . $_POST['id']); // กลับไปที่หน้า edit
        exit;
    }
    
    // เรียกใช้ฟังก์ชันใน Model เพื่ออัพเดทข้อมูล
    if (updateActivity($_POST['id'], $name, $description, $start_date, $end_date, $image_links)) {
        $_SESSION['success'] = "แก้ไขกิจกรรมสำเร็จ!";
        header("Location: /choose_activity");
        exit;
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการแก้ไขกิจกรรม";
        header("Location: /activities");
        exit;
    }
}
?>