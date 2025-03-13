<?php
$uid = $_GET['id'];  // รับค่า id จาก URL

if ($uid) {
    // ดึงข้อมูลกิจกรรมพร้อมข้อมูล history
    $activitises = filterActByUid($uid);
    if (($activitises)) {
        renderView('history_get', ['activitise' => $activitises]);
    }else{
        echo "<p>ไม่พบข้อมูลประวัติการขอเข้าร่วมกิจกรรม</p>";
    }
} else {
    echo "<p>ไม่พบกิจกรรมที่ขอเข้าร่วม</p>";
}