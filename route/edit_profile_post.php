<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];

     // ตรวจสอบค่าจากฟอร์ม
     if (!$id || !$first_name || !$last_name || !$phone) {
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

    if (updateUser($id, $first_name, $last_name, $phone, $image_string)) {
        echo "ลงทะเบียนสำเร็จ!";
        $user = getUserById($_SESSION['id']);
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['image'] = $user['image'];
        header("Location: /profile");
        
    } else {
        echo "เกิดข้อผิดพลาดในการลงทะเบียน!";
    }
}
?>
