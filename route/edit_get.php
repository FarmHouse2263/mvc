<?php
$activitise = getActivities(); 

// ส่งข้อมูลกิจกรรมไปยัง view (templat/edit_get.php)

renderView('edit_get', ['activitise' => $activitise]);
?>
