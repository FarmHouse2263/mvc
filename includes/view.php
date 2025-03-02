<?php

declare(strict_types=1);

function renderView(string $template, array $data = []): void
{
    // แสดง header เฉพาะเมื่อ $showHeader เป็น true
    include TEMPLATES_DIR . '/header.php';

    // รวมไฟล์ template ที่ต้องการ
    include TEMPLATES_DIR . '/' . $template . '.php';
}
