<?php
function getConnection(): mysqli
{
    $hostname = 'localhost';
    $dbName = 'demo';
    $password = 'pj';
    $username = 'pj';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/authen.php';
include_once DATABASE_DIR . '/activities.php';
include_once DATABASE_DIR . '/approvals.php';
