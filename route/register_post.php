<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $user_type = $_POST['user_type'];

    if (register($first_name, $last_name, $email, $password, $phone, $birthday, $user_type)) {
        echo "ลงทะเบียนสำเร็จ!";
        header("Location: /login");
    } else {
        echo "เกิดข้อผิดพลาดในการลงทะเบียน!";
    }
}
?>
