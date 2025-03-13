<?php
// เช็คว่า $_SESSION['activities'] มีค่าหรือไม่
if (isset($_SESSION['activities']) && !empty($_SESSION['activities'])) {
    // ถ้ามีค่าก็ใช้ค่าใน $_SESSION['activities']
    $activitise = $_SESSION['activities'];
} else {
    // ถ้าไม่มีค่าก็ใช้ฟังก์ชัน getActivities()
    $activitise = getActivities();
}

if (isset($_GET['deleted']) && $_GET['deleted'] == 'success'): ?>
    <div class="alert alert-success" role="alert">
        กิจกรรมถูกลบสำเร็จ
    </div>
<?php endif;

renderView('choose_activity_get', ['activitise' => $activitise]);
unset($_SESSION['activities']);
?>