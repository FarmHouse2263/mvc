<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if (addActivity($title, $description, $start_date, $end_date, $image)) {
        echo 'แก้ไขข้อมูลสำเร็จ!';
        header('Location: /Choose_activity');
        echo $title;
    } else {
        echo 'แก้ไม่ได้อ่ะ!!!!';
        echo $title;
        
    }
}
