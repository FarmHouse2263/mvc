<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['ap_id'])) {
    die("ไม่พบผู้ขอเข้าร่วมกิจกรรมที่ต้องการปฏิเสธ");
}

$ap_id = intval($_GET['ap_id']);
$result = rejectUser($ap_id);

    header("Location: /req_activity");
    header("Location: /rejected");
?>