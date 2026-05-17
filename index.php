<?php
/**
 * index.php — Gateway Halaman Utama (Toko / User)
 * Step 6C: Entry point untuk halaman user
 *
 * Alur: index.php → UserController → views/user_toko.php
 */

session_start();

require_once __DIR__ . '/controllers/UserController.php';

$controller = new UserController();
$controller->handle();
