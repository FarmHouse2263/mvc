<?php

// ฟังก์ชันดึงข้อมูล activity ทั้งหมดจากฐานข้อมูล
function getActivities() {
    // เชื่อมต่อกับฐานข้อมูล
    $conn = getConnection();

 
    $sql = "SELECT * FROM activites";

    // ดำเนินการ SQL
    $result = $conn->query($sql);

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    $activities = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
        }
    }

    return $activities;
}

?>
