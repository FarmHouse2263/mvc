<?php
// ดึงข้อมูลกิจกรรม
$activitise = getActivities();

// ดึงข้อมูลผู้ใช้จากฟังก์ชัน email
$users = email($email);

// ส่งข้อมูลทั้งหมดไปยัง view
renderView('Choose_activity_get', ['activitise' => $activitise,'users' => $users]);
