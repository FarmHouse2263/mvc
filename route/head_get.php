<?php
    session_start();
    $email = $_SESSION['email'] ?? null; // ดึงอีเมลจาก session ถ้ามี
    renderView('header_get', ['email' => $email]); 
?>
