<?php

declare(strict_types=1);
function getActivities()
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity";
    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getData($id)
{
    $conn = getConnection();

    if (!$conn) {
        die("Database connection variable (\$conn) not found.");
    }

    if (!$id) {
        die("ไม่พบกิจกรรม");
    }

    $id = $conn->real_escape_string($id);
    $query = "SELECT * FROM activity WHERE aid = '$id'";
    $result = $conn->query($query);

    if (!$result || $result->num_rows == 0) {
        return null;
    }

    return $result->fetch_assoc();
}


function getActivityById($aid)
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return null;
    }

    $activity = $result->fetch_assoc();
    $stmt->close();
    return $activity ?: null;
}


function updateActivity($aid, $title, $description, $start_date, $end_date, $image)
{
    $conn = getConnection();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE activity SET title = ?, description = ?, start_date = ?, end_date = ?, image = ? WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $title, $description, $start_date, $end_date, $image, $aid);

    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->close();
    return true; // หรือ false หากเกิดข้อผิดพลาด
}




function addActivity($title, $description, $start_date, $end_date, $image_string, $org_id)
{
    // เชื่อมต่อฐานข้อมูล
    $conn = getConnection();

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // เตรียมคำสั่ง SQL เพื่อเพิ่มข้อมูล
    $stmt = $conn->prepare("INSERT INTO activity (title, description, start_date, end_date, image, 	organizer_id	) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $description, $start_date, $end_date, $image_string, $org_id);

    // ตรวจสอบการเพิ่มข้อมูล
    if ($stmt->execute()) {
        return true;
    } else {
        echo "Error: " . $stmt->error;
        return false;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}



function deleteActivity($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        return "ไม่พบกิจกรรมที่ต้องการลบ";
    }

    $activity = $result->fetch_assoc();
    $image_url = $activity['image_url'] ?? '';
    $sql = "DELETE FROM activity WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        if (!empty($image_url) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_url)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $image_url);
        }
        return 'ลบกิจกรรมสำเร็จ';
    } else {
        return 'ไม่สามารถลบกิจกรรมได้';
    }
    $stmt->close();
    $conn->close();
}


function isCreator($aid)
{
    if (!isset($_SESSION['id'])) {
        return false;
    }
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE aid = ? AND id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $aid, $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows > 0;
}

function searchActivities($searchTerm)
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function searchActivitiesBydate($start_date, $end_date)
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity WHERE start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $start_date, $end_date, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
}


// ฟังก์ชันสำหรับตรวจสอบและสร้างโฟลเดอร์หากไม่มีก
function createUploadDir(string $uploadDir): bool
{
    if (!file_exists($uploadDir)) {
        return mkdir($uploadDir, 0755, true);
    }
    return true;
}

// ฟังก์ชันสำหรับตรวจสอบและอัปโหลดไฟล์
function uploadFiles(array $files, string $uploadDir): array
{
    $uploaded_files = [];
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $fileName = basename($files['name'][$key]);
        $targetPath = $uploadDir . uniqid() . '-' . $fileName; // ตั้งชื่อไฟล์ให้ไม่ซ้ำกัน

        // ตรวจสอบขนาดไฟล์และประเภทไฟล์ (ตัวอย่างตรวจสอบว่าไฟล์เป็น .jpg หรือ .png)
        $allowedTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($tmp_name);
        if (!in_array($fileType, $allowedTypes)) {
            continue;  // ข้ามไฟล์ที่ไม่ตรงตามประเภท
        }

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($tmp_name, $targetPath)) {
            $uploaded_files[] = $targetPath; // เก็บเส้นทางไฟล์ที่อัปโหลดสำเร็จ
        }
    }
    return $uploaded_files;
}
