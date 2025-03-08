<?php
function register($first_name, $last_name, $email, $password, $phone, $date, $user_type)
{
    $conn = getConnection();
    $check_sql = "SELECT * FROM userss WHERE email = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return "อีเมลนี้ถูกใช้งานแล้ว!";
    }

    $check_empty = "SELECT COUNT(*) FROM userss";
    $result = $conn->query($check_empty);
    $row = $result->fetch_array();

    if ($row[0] == 0) {
        $conn->query("ALTER TABLE userss AUTO_INCREMENT = 1");
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO userss (first_name, last_name, email, password, phone, date, user_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $hashed_password, $phone, $date, $user_type);

    if ($stmt->execute()) {
        return "ลงทะเบียนสำเร็จ!";
    } else {
        return "เกิดข้อผิดพลาด: " . $stmt->error;
    }
}

function login($email, $password): bool
{
    $conn = getConnection();
    $sql = "SELECT * FROM userss WHERE email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;
            return true;
        }
    }
    return false;
}
function isLoggedIn(): bool
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}
function checkLogin()
{
    if (!isLoggedIn()) {
        header('Location: /login');
        exit();
    }
}

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header('Location: /login');
    exit();
}

// ฟังก์ชันเพื่อดึงข้อมูลอีเมลของผู้ใช้จาก session
function getEmail()
{
    if (isset($_SESSION['email'])) {
        return $_SESSION['email']; // คืนค่าอีเมล
    }

    return null; // ถ้าไม่มีอีเมลใน session ให้ return null
}
