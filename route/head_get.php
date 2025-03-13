<?php
    session_start();
    $email = $_SESSION['email'] ?? null; // ดึงอีเมลจาก session ถ้ามี
    renderView('choose_activity_get', ['email' => $email]); 
?>
