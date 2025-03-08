<?php

declare(strict_types=1);

function renderView(string $template, array $data = []): void
{
    extract($data);
    
    include TEMPLATES_DIR . '/header_get.php'; 
    include TEMPLATES_DIR . '/' . $template . '.php';
    // include ROUTE_DIR . '/'. $route . '.php';
}
