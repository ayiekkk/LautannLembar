<?php
/**
 * login.php — Gateway untuk Login
 * Step 6A: Entry point, hanya mengorganisir pemanggilan controller
 *
 * Alur: login.php → LoginController → views/login.php
 */

// Mulai session di setiap entry point
session_start();

// Muat dan jalankan controller yang bertanggung jawab
require_once __DIR__ . '/controllers/LoginController.php';

$controller = new LoginController();
$controller->handle();
