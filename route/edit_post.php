<?php 
// เพิ่มโค้ดนี้ไว้ด้านบนของไฟล์
// ตรวจสอบว่าโฟลเดอร์ uploadss มีอยู่หรือไม่ 
if (!file_exists('uploadss')) {
    mkdir('uploadss', 0777, true); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // ใช้รูปเดิมเป็นค่าเริ่มต้น (จาก hidden field current_image)
    $image = $_POST['current_image'];   
    
    // ตรวจสอบว่ามีการอัปโหลดไฟล์ใหม่หรือไม่
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        // ตรวจสอบประเภทไฟล์ว่าเป็นภาพหรือไม่
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $image_extension = strtolower(pathinfo($_FILES['new_image']['name'], PATHINFO_EXTENSION));
        
        // ตรวจสอบขนาดไฟล์ไม่เกิน 5MB
        if ($_FILES['new_image']['size'] <= 5000000) {
            // ตรวจสอบว่าไฟล์เป็นภาพที่อนุญาตหรือไม่
            if (in_array($image_extension, $allowed_extensions)) {
                // สร้างชื่อไฟล์ใหม่เพื่อป้องกันการซ้ำกัน
                $new_filename = time() . '_' . basename($_FILES['new_image']['name']);
                $image = 'uploadss/' . $new_filename;
                
                // ตรวจสอบและแสดง error
                if (!move_uploaded_file($_FILES['new_image']['tmp_name'], $image)) {
                    error_log("Upload failed: " . print_r($_FILES, true));
                    $_SESSION['error'] = "ไม่สามารถอัปโหลดไฟล์ได้ กรุณาตรวจสอบสิทธิ์โฟลเดอร์";
                    header("Location: /edit?id=" . $_POST['id']);
                    exit;
                }
            } else {
                $_SESSION['error'] = "กรุณาอัปโหลดไฟล์ภาพเท่านั้น";
                header("Location: /edit?id=" . $_POST['id']);
                exit;
            }
        } else {
            $_SESSION['error'] = "ขนาดไฟล์ใหญ่เกินไป กรุณาอัปโหลดไฟล์ที่มีขนาดไม่เกิน 5MB";
            header("Location: /edit?id=" . $_POST['id']);
            exit;
        }
    }
    
    // เรียกใช้ฟังก์ชัน updateActivity เพื่ออัปเดตข้อมูลกิจกรรม
    if (updateActivity($_POST['id'], $name, $description, $start_date, $end_date, $image)) {
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