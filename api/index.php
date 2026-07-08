<?php
// BUKA PINTU CORS DARI GERBANG VERCEL
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// JEBAKAN FATAL ERROR TINGKAT TINGGI
try {
    // Cek apakah Vercel benar-benar menginstall package Laravel kita
    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        throw new Exception("CRITICAL ERROR: Folder 'vendor' tidak ada! Vercel gagal menjalankan 'composer install'.");
    }
    
    // Teruskan ke sistem utama Laravel
    require __DIR__ . '/../public/index.php';
    
} catch (\Throwable $e) {
    // Tangkap paksa error-nya dan print ke layar
    http_response_code(500);
    echo "<div style='background:#f8d7da; color:#721c24; padding:20px; border:1px solid #f5c6cb; font-family:sans-serif;'>";
    echo "<h2>🚨 LARAVEL FATAL CRASH BONGKAR 🚨</h2>";
    echo "<b>Pesan Error:</b> " . $e->getMessage() . "<br><br>";
    echo "<b>Lokasi File:</b> " . $e->getFile() . " <b>(Baris " . $e->getLine() . ")</b><br><br>";
    echo "<b>Jejak (Stack Trace):</b><br><pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
    exit();
}