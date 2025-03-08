<?php
// ฟังก์ชันเพื่อดึงข้อมูลกิจกรรมทั้งหมด
function getActivities()
{
    $conn = getConnection();

    $sql = "SELECT * FROM activities";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// ฟังก์ชันลบกิจกรรม
function deleteActivity($id)
{
    $conn = getConnection();

    // ตรวจสอบว่ามีกิจกรรมนี้ในฐานข้อมูลหรือไม่
    $sql = "SELECT * FROM activities WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ถ้ามีกิจกรรมในฐานข้อมูล, ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM activities WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // ตรวจสอบว่ามีรูปภาพที่ต้องลบหรือไม่
        $activity = $result->fetch_assoc();
        $image_url = $activity['image_url'] ?? '';
        if (!empty($image_url) && file_exists($_SERVER['DOCUMENT_ROOT'] . $image_url)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $image_url);
        }

        return true;
    }

    return false;
}
?>
