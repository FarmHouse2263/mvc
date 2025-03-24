<?php

if (!isset($_SESSION['id'])) {
    die("ไม่พบผู้ใช้");
}

$user = getUserById($_SESSION['id']);

if (!$user) {
    die("ไม่พบผู้ใช้");
}

renderView('edit_profile_get', ['user' => $user]);
?>
