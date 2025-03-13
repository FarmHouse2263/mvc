<?php
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

if ($start_date && $end_date) {
    $activities = searchActivitiesBydate($start_date,$end_date);
    $_SESSION['activities'] = $activities;
} else {
    $activities = getActivities();
}

if (count($activities) > 0) {
    foreach ($activities as $activity) {
        header('Location: /choose_activity');
        exit(); 
    }
} else {
    echo "<p>ไม่พบกิจกรรมที่ตรงกับคำค้นหา</p>";
}
