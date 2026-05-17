<?php
/**
 * logout.php — Gateway untuk Logout
 * Step 6B: Hanya menerima POST request untuk keamanan
 *
 * Alur: Tombol Logout (POST) → logout.php → LogoutController → redirect login.php
 */

session_start();

// Keamanan: tolak akses langsung via browser (GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/controllers/LogoutController.php';

$controller = new LogoutController();
$controller->handle();
