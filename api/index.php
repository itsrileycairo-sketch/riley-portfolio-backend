<?php
// BUKA PINTU CORS DARI GERBANG VERCEL
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Kalau browser ngecek preflight, langsung kasih lampu hijau
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Teruskan ke sistem utama Laravel
require __DIR__ . '/../public/index.php';