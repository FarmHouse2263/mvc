<?php

declare(strict_types=1);

// ตรวจสอบว่าค่าคงที่ถูกกำหนดหรือไม่
if (!defined('TEMPLATES_DIR')) {
    define('TEMPLATES_DIR', __DIR__ . '/../templat');
}

function renderView(string $templat, array $data = []): void
{
    extract($data);

    $headerPath = TEMPLATES_DIR . '/header_get.php';
    $templatePath = TEMPLATES_DIR . '/' . $templat . '.php';

    // ตรวจสอบว่าไฟล์มีอยู่ก่อน include
    if (!file_exists($headerPath)) {
        die("Error: Header template not found - $headerPath");
    }

    if (!file_exists($templatePath)) {
        die("Error: Template file not found - $templatePath");
    }

    include $headerPath;
    include $templatePath;

    // include TEMPLATES_DIR . '/closed_for_maintenance.php';
}
