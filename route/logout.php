<?php
// ฟังก์ชันสำหรับ logout
function logout() {
    session_start(); // เริ่ม session
    session_unset();  // ลบข้อมูลใน session
    session_destroy();  // ทำลาย session
    header("Location: /login");  // เปลี่ยนเส้นทางไปยังหน้า login
    exit();
}

// เรียกใช้ฟังก์ชัน logout
logout();
?>
