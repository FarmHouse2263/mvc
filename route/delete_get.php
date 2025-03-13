<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id'])) {
    die("ไม่พบกิจกรรมที่ต้องการลบ");
}

$id = intval($_GET['id']);
$result = deleteActivity($id);

if ($result === 'ลบกิจกรรมสำเร็จ') {
    echo $result;
    header("Location: /choose_activity");
    exit;
} else {
    echo "<script>
            alert('$result');
            window.location.href = '/choose_activity';
          </script>";
}