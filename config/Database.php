<?php
/**
 * Database.php
 * Class koneksi database menggunakan PDO (Singleton Pattern)
 * Step 1: Konfigurasi koneksi ke MySQL
 */
class Database {
    // Konfigurasi koneksi — sesuaikan dengan server Anda
    private $host     = 'localhost';
    private $db_name  = 'ojokerro_lautanlembardb';
    private $username = 'ojokerro_lautanlembar';
    private $password = 'LautanLembar123';
    private $charset  = 'utf8mb4';

    private $pdo = null;

    /**
     * Mendapatkan koneksi PDO
     * Hanya membuat koneksi baru jika belum ada (Singleton)
     */
    public function getConnection(): PDO {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                // Pada production, jangan tampilkan pesan error ke user
                die("Koneksi Database Gagal: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
