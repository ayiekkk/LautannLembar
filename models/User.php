<?php
/**
 * models/User.php
 * Model untuk operasi data User di database
 * Step 3A: Layer Model — hanya berinteraksi dengan database
 */
require_once __DIR__ . '/../config/Database.php';

class User {
    private ?mysqli $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    /**
     * Cari user berdasarkan username
     * Digunakan saat proses login
     */
    public function findByUsername(string $username): array|false {
        if ($this->db === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            "SELECT id, nama, username, password, role FROM users WHERE username = ? LIMIT 1"
        );
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result === false) {
            return false;
        }

        $data = $result->fetch_assoc();
        return $data ?? false;
    }

    /**
     * Verifikasi password yang dimasukkan user
     * Menggunakan password_verify() agar aman (tidak membandingkan plain text)
     */
    public function verifyPassword(string $inputPassword, string $hashedPassword): bool {
        return password_verify($inputPassword, $hashedPassword);
    }
}
