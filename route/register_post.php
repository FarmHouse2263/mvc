<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $user_type = $_POST['user_type'];

     // ตรวจสอบค่าจากฟอร์ม
     if (!$first_name || !$last_name || !$email || !$password || !$phone || !$birthday  || !$user_type) {
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
    $uploaded_files = uploadFiles($_FILES['image'], $uploadDir);

    if (empty($uploaded_files)) {
        echo "ไม่พบไฟล์ที่อัปโหลดหรือเกิดข้อผิดพลาดในการอัปโหลดไฟล์<br>";
        exit;
    }

    // รวมชื่อไฟล์ทั้งหมดเป็นสตริงเดียว
    $image_string = implode(',', $uploaded_files);

    if (register($first_name, $last_name, $email, $password, $phone, $birthday, $image_string, $user_type)) {
        echo "ลงทะเบียนสำเร็จ!";
        header("Location: /login");
    } else {
        echo "เกิดข้อผิดพลาดในการลงทะเบียน!";
    }
}
?>
