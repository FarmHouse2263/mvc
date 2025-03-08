<?php
    session_start();
    $email = $_SESSION['email'] ?? null; // ดึงอีเมลจาก session ถ้ามี
    renderView('Choose_activity_get', ['email' => $email]); 
?>
