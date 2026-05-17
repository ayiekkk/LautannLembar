<?php
/**
 * models/User.php
 * Model untuk operasi data User di database
 * Step 3A: Layer Model — hanya berinteraksi dengan database
 */
require_once __DIR__ . '/../config/Database.php';

class User {
    private PDO $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Cari user berdasarkan username
     * Digunakan saat proses login
     */
    public function findByUsername(string $username): array|false {
        $stmt = $this->db->prepare(
            "SELECT id, nama, username, password, role FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);
        return $stmt->fetch(); // Mengembalikan array atau false jika tidak ditemukan
    }

    /**
     * Verifikasi password yang dimasukkan user
     * Menggunakan password_verify() agar aman (tidak membandingkan plain text)
     */
    public function verifyPassword(string $inputPassword, string $hashedPassword): bool {
        return password_verify($inputPassword, $hashedPassword);
    }
}
