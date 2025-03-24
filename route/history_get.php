<?php
$activitise = getUserActivities($_SESSION['id']);
$approval_status = getAllApprovaldata($_SESSION['id']);
// unset($_SESSION['selected_activity']);
// $approval_status = getApprovalStatus($_SESSION['selected_activity']);

// echo "<pre>กิจกรรม: ";
// var_dump($activitise);
// echo "</pre>";

// echo "<pre>สถานะอนุมัติ: ";
// var_dump($approval_status);
// echo "</pre>";

renderView('history_get', ['activitise' => $activitise, 'approval_status' => $approval_status]);

