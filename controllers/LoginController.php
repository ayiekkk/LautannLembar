<?php
/**
 * controllers/LoginController.php
 * Controller untuk menangani proses Login & Autentikasi
 * Step 4A: Logika login, bukan tampilan
 */
require_once __DIR__ . '/../models/User.php';

class LoginController {

    private User $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    /**
     * Entry point controller — dipanggil dari login.php (gateway)
     * Memisahkan request GET (tampilkan form) dan POST (proses login)
     */
    public function handle(): void {
        // Jika sudah login, langsung redirect sesuai role
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole($_SESSION['role']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processLogin();
        } else {
            // GET: Tampilkan form login
            $this->showLoginView();
        }
    }

    /**
     * Proses validasi dan autentikasi login (dipanggil saat POST)
     */
    private function processLogin(): void {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validasi input tidak boleh kosong
        if (empty($username) || empty($password)) {
            $error = "Username dan password tidak boleh kosong.";
            $this->showLoginView($error);
            return;
        }

        // Cari user di database
        $user = $this->userModel->findByUsername($username);

        // Cek apakah user ada dan password cocok
        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            // Login berhasil — simpan data ke session
            session_regenerate_id(true); // Cegah Session Fixation Attack
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            $this->redirectByRole($user['role']);
        } else {
            // Login gagal
            $error = "Username atau password salah. Silakan coba lagi.";
            $this->showLoginView($error);
        }
    }

    /**
     * Tampilkan view login (dengan pesan error opsional)
     */
    private function showLoginView(?string $error = null): void {
        // Variabel $error akan tersedia di view
        require_once __DIR__ . '/../views/login.php';
    }

    /**
     * Redirect user ke halaman yang sesuai berdasarkan role
     */
    private function redirectByRole(string $role): void {
        if ($role === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
        exit;
    }
}
