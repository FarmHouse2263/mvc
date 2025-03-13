<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $org_id = $_POST['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // แก้จาก $_POST['image'] เป็น $_POST['images']
    $images = $_POST['images']; 
    $image_string = implode(',', $images);
    
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    if (addActivity($title, $description, $start_date, $end_date, $image_string, $org_id)) {
        // ย้าย header ขึ้นมาก่อน echo และเพิ่ม exit()
        header('Location: /choose_activity');
        exit();
        // echo 'เพิ่มกิจกรรมสำเร็จ!'; // ไม่จำเป็นเพราะจะ redirect ไปแล้ว
    } else {
        echo 'เพิ่มกิจกรรมไม่สำเร็จ!';
        echo $title;
    }
}
?>