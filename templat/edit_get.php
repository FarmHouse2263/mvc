<?php
// เริ่มการเชื่อมต่อฐานข้อมูล
require_once __DIR__ . '/../includes/db.php'; // เส้นทางของไฟล์การเชื่อมต่อฐานข้อมูล

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ไม่พบรหัสกิจกรรม");
}

$activity_id = $_GET['id'];

// เชื่อมต่อกับฐานข้อมูล
$mysqli = getConnection();

if ($mysqli->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $mysqli->connect_error);
}

// ดึงข้อมูลกิจกรรมจากฐานข้อมูล
$sql = "SELECT * FROM activity WHERE aid = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die("การเตรียมคำสั่ง SQL ล้มเหลว: " . $mysqli->error);
}

$stmt->bind_param('i', $activity_id);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบว่ามีกิจกรรมในฐานข้อมูลหรือไม่
if ($result->num_rows === 0) {
    die("ไม่พบกิจกรรมที่มีรหัสนี้");
}

$activity = $result->fetch_assoc();

$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container mt-5">
        <form action="edit" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($activity['aid'] ?? '') ?>">
            <div class="mb-3">
                <label for="activity_name" class="form-label">ชื่อกิจกรรม</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="activity_description" class="form-label">รายละเอียดกิจกรรม</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="activity_image" class="form-label">ลิงก์ภาพกิจกรรม</label>
                <input type="url" class="form-control" id="image" name="image" required>
            </div>

            

            <div class="mb-3">
                <label for="start_date" class="form-label">วันที่เริ่มกิจกรรม</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">วันที่สิ้นสุดกิจกรรม</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>


                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> บันทึก</button>
                    <a href="/Choose_activity" class="btn btn-secondary"><i class="bi bi-x-circle"></i> ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast แจ้งเตือน -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ แก้ไขกิจกรรมสำเร็จ!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</body>

</html>