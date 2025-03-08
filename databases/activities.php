<?php


function getActivities()
{
    $conn = getConnection();
    $sql = "SELECT * FROM activity";
    $result = $conn->query($sql);

    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getData()
{
    $conn = getConnection();

    if (!$conn) {
        die("Database connection variable (\$conn) not found.");
    }

    $id = $_GET['id'] ?? null;

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
    $activity = $result->fetch_assoc();
    $stmt->close();
    return $activity ?: null;
}

function updateActivity($aid, $title, $description, $start_date, $end_date, $image)
{
    $conn = getConnection();
    $sql = "UPDATE activity SET title = ?, description = ?, start_date = ?, end_date = ?, image = ? WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $title, $description, $start_date, $end_date, $image, $aid);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function addActivity($title, $description, $start_date, $end_date, $image)
{
    $conn = getConnection();
    $sql = "INSERT INTO activity (title, description, start_date, end_date, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $description, $start_date, $end_date, $image);
    $success = $stmt->execute();
    $stmt->close();
    return $success ? "เพิ่มข้อมูลสำเร็จ!" : "เกิดข้อผิดพลาด: " . $conn->error;
}

function deleteActivity($id)
{
    $conn = getConnection();
    $activity = getActivityById($id);

    if (!$activity) {
        return false;
    }

    $sql = "DELETE FROM activity WHERE aid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // ลบรูปภาพถ้ามี
    $image_url = $activity['image'] ?? '';
    if (!empty($image_url) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_url)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $image_url);
    }

    return true;
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
