<?php
/**
 * controllers/AdminController.php
 * Controller untuk semua aksi Admin (Dashboard + CRUD Buku)
 * Step 4D: Routing aksi dan validasi data
 */
require_once __DIR__ . '/../models/Buku.php';

class AdminController {

    private Buku $bukuModel;

    public function __construct() {
        $this->bukuModel = new Buku();
    }

    /**
     * Entry point — dipanggil dari admin.php
     * Router internal berdasarkan parameter ?aksi=...
     */
    public function handle(): void {
        // 1. CEK OTORISASI — hanya role 'admin'
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: login.php');
            exit;
        }

        // 2. ROUTING berdasarkan ?aksi= di URL
        $aksi = $_GET['aksi'] ?? 'dashboard';

        match ($aksi) {
            'tambah' => $this->tambah(),
            'ubah'   => $this->ubah(),
            'hapus'  => $this->hapus(),
            default  => $this->dashboard(),
        };
    }

    // ─────────────────────────────────────────────
    // DASHBOARD: Tampilkan semua buku
    // ─────────────────────────────────────────────
    private function dashboard(): void {
        $daftar_buku = $this->bukuModel->readAll();
        $total_buku  = $this->bukuModel->count();
        $pesan       = $_SESSION['flash_message'] ?? null;
        unset($_SESSION['flash_message']); // Hapus setelah dibaca

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    // ─────────────────────────────────────────────
    // TAMBAH: Form tambah buku (GET) & Simpan (POST)
    // ─────────────────────────────────────────────
    private function tambah(): void {
        $errors = [];
        $data   = []; // Data lama untuk re-fill form jika gagal

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                if ($this->bukuModel->create($data)) {
                    $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Buku berhasil ditambahkan!'];
                    header('Location: admin.php');
                    exit;
                } else {
                    $errors[] = "Gagal menyimpan buku ke database.";
                }
            }
        }

        // GET atau POST gagal: tampilkan form
        require_once __DIR__ . '/../views/admin/tambah.php';
    }

    // ─────────────────────────────────────────────
    // UBAH: Form edit buku (GET) & Update (POST)
    // ─────────────────────────────────────────────
    private function ubah(): void {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id <= 0) {
            header('Location: admin.php');
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data   = $this->sanitizeInput($_POST);
            $errors = $this->validate($data);

            if (empty($errors)) {
                if ($this->bukuModel->update($id, $data)) {
                    $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Data buku berhasil diperbarui!'];
                    header('Location: admin.php');
                    exit;
                } else {
                    $errors[] = "Gagal memperbarui data buku.";
                }
            }
            // Kalau ada error, gunakan data dari POST (bukan dari DB)
            $data['id'] = $id;
        } else {
            // GET: Ambil data buku dari database untuk mengisi form
            $data = $this->bukuModel->readOne($id);
            if (!$data) {
                header('Location: admin.php');
                exit;
            }
        }

        require_once __DIR__ . '/../views/admin/ubah.php';
    }

    // ─────────────────────────────────────────────
    // HAPUS: Hapus buku (hanya POST untuk keamanan)
    // ─────────────────────────────────────────────
    private function hapus(): void {
        // Hapus hanya boleh via POST (bukan link langsung/GET)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: admin.php');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);

        if ($id > 0 && $this->bukuModel->delete($id)) {
            $_SESSION['flash_message'] = ['type' => 'success', 'text' => 'Buku berhasil dihapus.'];
        } else {
            $_SESSION['flash_message'] = ['type' => 'error', 'text' => 'Gagal menghapus buku.'];
        }

        header('Location: admin.php');
        exit;
    }

    // ─────────────────────────────────────────────
    // HELPER: Sanitasi input POST
    // ─────────────────────────────────────────────
    private function sanitizeInput(array $post): array {
        return [
            'judul'     => trim(htmlspecialchars($post['judul'] ?? '', ENT_QUOTES)),
            'penulis'   => trim(htmlspecialchars($post['penulis'] ?? '', ENT_QUOTES)),
            'penerbit'  => trim(htmlspecialchars($post['penerbit'] ?? '', ENT_QUOTES)),
            'harga'     => (float) ($post['harga'] ?? 0),
            'stok'      => (int)   ($post['stok'] ?? 0),
            'cover_url' => trim($post['cover_url'] ?? ''),
            'deskripsi' => trim($post['deskripsi'] ?? ''),
        ];
    }

    // ─────────────────────────────────────────────
    // HELPER: Validasi data buku
    // ─────────────────────────────────────────────
    private function validate(array $data): array {
        $errors = [];

        if (empty($data['judul']))    $errors[] = "Judul buku wajib diisi.";
        if (empty($data['penulis']))  $errors[] = "Nama penulis wajib diisi.";
        if (empty($data['penerbit'])) $errors[] = "Nama penerbit wajib diisi.";
        if ($data['harga'] <= 0)      $errors[] = "Harga harus lebih dari 0.";
        if ($data['stok'] < 0)        $errors[] = "Stok tidak boleh negatif.";

        return $errors;
    }
}
