<?php
{
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(login($email, $password)) {
            echo 'เข้าสู่ระบบสำเร็จ';
            header('Location: /choose_activity');
        }
        else {
            echo 'ใส่ผิดอ่ะ';
        }
    }

}
?>
