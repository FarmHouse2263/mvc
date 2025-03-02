<?php

// ฟังก์ชันตรวจสอบการเข้าสู่ระบบ
function login($username, $password): bool
{
    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

    // คำสั่ง SQL เพื่อตรวจสอบผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE username = ?"; // เรียก table users

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);  //เพื่อหลีกเลี่ยง SQL Injection
    $stmt->execute();
    $result = $stmt->get_result();

    // หากพบผู้ใช้
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // ตรวจสอบรหัสผ่าน
        if (password_verify($password, $user['password'])) {
            // ถ้ารหัสผ่านถูกต้อง, คืนค่าผู้ใช้
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true;
            return true;
        }
    }

    // ถ้าการตรวจสอบไม่ผ่าน
    return false;
}

// ฟังก์ชันตรวจสอบว่า user เข้าสู่ระบบหรือยัง
function isLoggedIn(): bool
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// ฟังก์ชันตรวจสอบว่า user มีสิทธิ์เข้าถึงหรือไม่
function checkLogin()
{
    if (!isLoggedIn()) {
        header('Location: /login');
        exit();
    }
}

// ฟังก์ชัน logout
function logout()
{
    session_start();
    session_unset();  // ล้างค่าทุกตัวแปรใน session
    session_destroy();  // ลบ session
    header('Location: /login');
    exit();
}


function email($email)
{
    // เชื่อมต่อฐานข้อมูล
    $conn = getConnection();

    // สร้างคำสั่ง SQL
    $sql = "SELECT * FROM users WHERE email = ?";

    // เตรียมคำสั่ง SQL
    $stmt = $conn->prepare($sql);

    // ผูกค่าพารามิเตอร์
    $stmt->bind_param('s', $email);  // สำหรับ mysqli ใช้ bind_param()

    // Execute คำสั่ง SQL
    $stmt->execute();
    $result = $stmt->get_result();

    // ตรวจสอบผลลัพธ์
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        return $user['email'];
    } else {
        return false;
    }
}
