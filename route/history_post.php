<?php
// ดึงข้อมูลจาก $_POST
$aid = $_POST['activity_id'] ?? ''; // ถ้าไม่มีค่าจะตั้งค่าเป็นค่าว่าง
$rid = $_POST['rid'] ?? ''; // ID ของผู้สร้างกิจกรรม
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';

$approval_by = get_user_data($_SESSION['first_name']);
$approval_status = 'Pending';
$approval_date = date('Y-m-d H:i:s');

// ตรวจสอบค่า aid ว่าว่างหรือไม่
if (empty($aid)) {
    echo "ค่า 'aid' ว่างหรือไม่ได้รับการส่งมา!";
    // หรือทำการยกเลิกกระบวนการต่อไป
    exit();
}

$_SESSION['selected_activity'] = [  
    'aid' => $aid,
    'created_by' => $rid,
    'title' => $title,
    'description' => $description,
    'start_date' => $start_date,
    'end_date' => $end_date,
];

insertApprovalData($aid, $rid, $approval_by, $approval_status, $approval_date);

// เปลี่ยนเส้นทางไปยังหน้า /history
header("Location: /history");
exit();

?>
