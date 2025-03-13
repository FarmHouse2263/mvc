<?php

$activity = getActivityById($_GET['id'] ?? null);

if (!$activity) {
    die("ไม่พบกิจกรรม");
}

renderView('edit_get', ['activity' => $activity]);
?>
