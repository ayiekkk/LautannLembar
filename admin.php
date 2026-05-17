<?php
/**
 * admin.php — Gateway Halaman Admin
 * Step 6D: Entry point untuk semua aksi admin (CRUD)
 *
 * Alur: admin.php?aksi=... → AdminController → views/admin/...
 *
 * Contoh URL routing:
 *  admin.php              → dashboard (daftar buku)
 *  admin.php?aksi=tambah  → form tambah buku
 *  admin.php?aksi=ubah&id=3 → form edit buku id 3
 *  admin.php?aksi=hapus   → proses hapus (POST)
 */

session_start();

require_once __DIR__ . '/controllers/AdminController.php';

$controller = new AdminController();
$controller->handle();
