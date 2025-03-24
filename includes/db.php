<?php
function getConnection(): mysqli
{
    // $hostname = '122.155.18.18';
    // $dbName = 'activitydf_activitydf';
    // $username = 'activitydf_activitydf';
    // $password = 'uSM_8QG8j5g7MLg';

     $hostname = 'localhost';
     $dbName = 'demo';
     $username = 'pj';
     $password = 'pj';
    $conn = new mysqli($hostname, $username, $password, $dbName);
    
    if ($conn->connect_error) {
        die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
    }
    return $conn;
}

require_once DATABASE_DIR . '/authen.php';
include_once DATABASE_DIR . '/activities.php';
include_once DATABASE_DIR . '/approvals.php';
include_once DATABASE_DIR . '/req_activity.php';

