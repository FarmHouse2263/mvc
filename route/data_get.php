<?php
$id = $_GET['id'] ?? null;
$activity = getData($id);
if (!$activity) {
    die("ไม่พบข้อมูลกิจกรรม");
}

renderView('/data_get', ['activity' => $activity]);
