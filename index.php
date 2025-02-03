<?php
session_start();
require_once 'config/database.php';

// Redirect ke login jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}

// Set default page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$content_path = "pages/{$page}.php";

// Validasi file exists
if (!file_exists($content_path)) {
    $content_path = "pages/dashboard.php";
}

// Include layout utama
include 'layouts/main.php';
?> 