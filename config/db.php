<?php
// ✅ Start session globally
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$env = __DIR__ . '/.env';
// Check if .env file exists
if (!file_exists($env)) {
    die('❌ Missing config/.env — create it and add credentials.');
}

// Load environment variables
$vars = parse_ini_file($env);

$host = $vars['DB_HOST'] ?? 'localhost';
$db   = $vars['DB_NAME'] ?? 'ai_poems';
$user = $vars['DB_USER'] ?? 'root';
$pass = $vars['DB_PASS'] ?? '';

$dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

try {
    // ✅ Create PDO connection
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throw exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // associative arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // use real prepared statements
    ]);
} catch (PDOException $e) {
    die('❌ DB Connection failed: ' . $e->getMessage());
}
