<?php
function register($first_name, $last_name, $email, $password, $phone, $date,$image_string , $user_type)
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

    $sql = "INSERT INTO userss (first_name, last_name, email, password, phone, date, image, user_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $hashed_password, $phone, $date, $image_string, $user_type);

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
            $_SESSION['phone'] = $user['phone']; // เก็บหมายเลขโทรศัพท์
            $_SESSION['image'] = $user['image'];
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

// ฟังก์ชันเพื่อดึงข้อมูลอีเมลของผู้ใช้จาก session
function getEmail()
{
    if (isset($_SESSION['email'])) {
        return $_SESSION['email']; // คืนค่าอีเมล
    }

    return null; // ถ้าไม่มีอีเมลใน session ให้ return null
}

function get_user_data() {
    global $conn;

    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    $user_id = $_SESSION['id'];
    $sql = "SELECT first_name, last_name, email, phone, address, profile_image FROM userss WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

function getUserById($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM userss WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc() ?: null; // คืนค่าแค่ 1 แถว หรือ null ถ้าไม่พบ
}


function updateUser($id, $first_name, $last_name, $phone, $uploaded_files)
{

    $conn = getConnection();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE userss SET first_name = ?, last_name = ?, phone = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $uploaded_files, $id);

    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->close();
    return true; // หรือ false หากเกิดข้อผิดพลาด
}



function logout() {
    // เริ่มเซสชัน (ถ้ายังไม่ได้เริ่ม)
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // ล้างข้อมูลทั้งหมดในเซสชัน
    $_SESSION = array();
    
    // ลบคุกกี้เซสชัน
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // ทำลายเซสชัน
    session_destroy();
    
    // เปลี่ยนเส้นทางไปยังหน้าล็อกอิน
    header("Location: login.php");
    exit();
}
