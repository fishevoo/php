<?php
// Set base path
define('BASE_PATH', dirname(__DIR__));

// Include necessary files
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/includes/main.php';

session_start();

// Redirect ke login jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}

// Set default page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$content_path = BASE_PATH . "/pages/{$page}.php";

// Validasi file exists
if (!file_exists($content_path)) {
    $content_path = BASE_PATH . "/pages/dashboard.php";
}

// Include layout utama
include BASE_PATH . '/layouts/main.php';
?> 