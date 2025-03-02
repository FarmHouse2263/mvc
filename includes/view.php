<?php

declare(strict_types=1);

function renderView(string $template, array $data = [], bool $showHeader = true): void
{
    // แสดง header เฉพาะเมื่อ $showHeader เป็น true
    if ($showHeader) {
        include TEMPLATES_DIR . '/header.php';
    }
    
    // รวมไฟล์ template ที่ต้องการ
    include TEMPLATES_DIR . '/' . $template . '.php';
}
