<?php
$activity = getData();
if (!$activity) {
    die("ไม่พบข้อมูลกิจกรรม");
}

renderView('/data_get', ['activity' => $activity]);
