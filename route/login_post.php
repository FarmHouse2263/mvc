<?php
// ตรวจสอบสถานะ session ว่ามีการเริ่มต้นหรือยัง
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ถ้า user เข้าสู่ระบบแล้ว ให้เปลี่ยนเส้นทางไปยังหน้า Choose_activity
if (isset($_SESSION['username'])) {
    header('Location: /Choose_activity'); // เปลี่ยนเส้นทางไปยังหน้า Choose_activity
    exit();
}

// เชื่อมต่อฐานข้อมูล
$mysqli = getConnection();

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($mysqli->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มเข้าสู่ระบบ
    $username = $_POST['username'];
    $password = $_POST['password'];

    // เช็คการกรอกข้อมูล
    if (empty($username) || empty($password)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit;
    }

    // คำสั่ง SQL สำหรับดึงข้อมูลผู้ใช้
    $sql = "SELECT * FROM users WHERE username = ?";

    // เตรียมคำสั่ง SQL
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt === false) {
        die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $mysqli->error);
    }

    $stmt->bind_param('s', $username); // Bind parameter
    $stmt->execute(); // ประมวลผลคำสั่ง SQL
    $result = $stmt->get_result(); // รับผลลัพธ์

    // ตรวจสอบข้อมูลผู้ใช้
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // ตั้งค่าการเข้าสู่ระบบสำเร็จ
            $_SESSION['username'] = $user['username'];
            header('Location: /Choose_activity'); // เปลี่ยนเส้นทางไปยังหน้าแดชบอร์ด
            exit();
        } else {
            echo "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        echo "ไม่พบผู้ใช้";
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $mysqli->close();
}
?>
