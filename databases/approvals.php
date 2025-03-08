<?php
function myAddActivity()
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO activities (title, start_date, end_date, location, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $start_date, $end_date, $location, $description);

    // ตรวจสอบการดำเนินการ
    if ($stmt->execute()) {
        echo "กิจกรรมถูกเพิ่มเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }
}
