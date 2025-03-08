<?php

declare(strict_types=1);

function renderView(string $template, array $data = []): void
{
    extract($data); // แปลง array เป็นตัวแปร เช่น ['email' => 'test@example.com'] → $email = 'test@example.com'
    
    include TEMPLATES_DIR . '/header_get.php'; 
    include TEMPLATES_DIR . '/' . $template . '.php';
}
