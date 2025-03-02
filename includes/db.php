<?php

function getConnection(): mysqli
{
    $hostname = 'localhost';
    $dbName = 'demo';
    $password = 'project';
    $username = 'project';
    
    // สร้างการเชื่อมต่อกับฐานข้อมูล
    $conn = new mysqli($hostname, $username, $password, $dbName);
    
    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }
    
    // คืนค่าการเชื่อมต่อฐานข้อมูล
    return $conn;
}

// ตรวจสอบการเรียกใช้ไฟล์อื่นๆ
require_once DATABASE_DIR . '/authen.php';
include_once DATABASE_DIR . '/activities.php';
