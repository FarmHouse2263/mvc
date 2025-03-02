<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบเส้นทางของไฟล์ authen.php ในโฟลเดอร์ databases
$authen_path = __DIR__ . '/../databases/authen.php';

if (!file_exists($authen_path)) { // เช็คไฟล์ authen.php ว่ามีอยู่ไหม ถเาไม่มีจะแสดงข้อความด้านล่าง
    die("ไม่พบไฟล์ authen.php ในเส้นทางที่ระบุ");
}

// ใช้ require_once หลังจากตรวจสอบเส้นทาง
require_once $authen_path;

require_once __DIR__ . '/../includes/db.php'; // เส้นทางของ db.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มสมัครสมาชิก
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $birthday = $_POST['birthday'];
    $phone_number = $_POST['phone_number'];

    // เช็คการกรอกข้อมูล
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($birthday) || empty($phone_number)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit;
    }

    // ตรวจสอบการยืนยันรหัสผ่าน
    if ($password !== $confirm_password) {
        echo "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
        exit;
    }

    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }

    // ตรวจสอบชื่อผู้ใช้ว่ามีอยู่ในฐานข้อมูลแล้วหรือไม่
    $sql_check_username = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stmt_check_username = $conn->prepare($sql_check_username);
    $stmt_check_username->bind_param('s', $username);
    $stmt_check_username->execute();
    $stmt_check_username->bind_result($count_username);
    $stmt_check_username->fetch();
    $stmt_check_username->close();

    if ($count_username > 0) {
        echo "ชื่อผู้ใช้นี้มีอยู่แล้ว กรุณาเลือกชื่อผู้ใช้ใหม่";
        exit;
    }

    // ตรวจสอบอีเมลว่ามีอยู่ในฐานข้อมูลแล้วหรือไม่
    $sql_check_email = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt_check_email = $conn->prepare($sql_check_email);
    $stmt_check_email->bind_param('s', $email);
    $stmt_check_email->execute();
    $stmt_check_email->bind_result($count_email);
    $stmt_check_email->fetch();
    $stmt_check_email->close();

    if ($count_email > 0) {
        echo "อีเมลนี้มีอยู่แล้ว กรุณาใช้อีเมลอื่น";
        exit;
    }

    // เข้ารหัสรหัสผ่านก่อนบันทึก
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL สำหรับบันทึกข้อมูลผู้ใช้
    $sql = "INSERT INTO users (username, email, password, birthday, phone_number) VALUES (?, ?, ?, ?, ?)";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $conn->error);
    }

    $stmt->bind_param('sssss', $username, $email, $hashed_password, $birthday, $phone_number);

    // ประมวลผลคำสั่ง SQL
    if ($stmt->execute()) {
        // หากสมัครสมาชิกสำเร็จ ให้เปลี่ยนเส้นทางไปหน้าเข้าสู่ระบบ
        header('Location: /login');
        exit();
    } else {
        // ถ้ามีข้อผิดพลาด
        echo "เกิดข้อผิดพลาดในการสมัครสมาชิก: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}
?>
