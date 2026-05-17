<?php
/**
 * controllers/UserController.php
 * Controller untuk halaman User (Katalog Toko)
 * Step 4C: Otorisasi + ambil data → serahkan ke View
 */
require_once __DIR__ . '/../models/Buku.php';

class UserController {

    private Buku $bukuModel;

    public function __construct() {
        $this->bukuModel = new Buku();
    }

    /**
     * Entry point — dipanggil dari index.php
     */
    public function handle(): void {
        // 1. CEK OTORISASI — hanya role 'user' yang boleh akses
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }

        // 2. AMBIL DATA dari Model
        $daftar_buku = $this->bukuModel->readAll();

        // 3. PANGGIL VIEW — variabel $daftar_buku otomatis tersedia di view
        require_once __DIR__ . '/../views/user_toko.php';
    }
}
