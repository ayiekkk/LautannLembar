<?php
/**
 * models/Buku.php
 * Model untuk operasi CRUD data Buku
 * Step 3B: Layer Model — semua query database ada di sini
 */
require_once __DIR__ . '/../config/Database.php';

class Buku {
    private PDO $db;
    private string $table = 'buku';

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // ─────────────────────────────────────────────
    // READ: Ambil semua buku
    // ─────────────────────────────────────────────
    public function readAll(): array {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC"
        );
        return $stmt->fetchAll();
    }

    // ─────────────────────────────────────────────
    // READ: Ambil satu buku berdasarkan ID
    // ─────────────────────────────────────────────
    public function readOne(int $id): array|false {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ─────────────────────────────────────────────
    // CREATE: Tambah buku baru
    // ─────────────────────────────────────────────
    public function create(array $data): bool {
        $sql = "INSERT INTO {$this->table} 
                    (judul, penulis, penerbit, harga, stok, cover_url, deskripsi)
                VALUES 
                    (:judul, :penulis, :penerbit, :harga, :stok, :cover_url, :deskripsi)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':judul'     => $data['judul'],
            ':penulis'   => $data['penulis'],
            ':penerbit'  => $data['penerbit'],
            ':harga'     => $data['harga'],
            ':stok'      => $data['stok'],
            ':cover_url' => $data['cover_url'] ?? null,
            ':deskripsi' => $data['deskripsi'] ?? null,
        ]);
    }

    // ─────────────────────────────────────────────
    // UPDATE: Update data buku
    // ─────────────────────────────────────────────
    public function update(int $id, array $data): bool {
        $sql = "UPDATE {$this->table} SET
                    judul    = :judul,
                    penulis  = :penulis,
                    penerbit = :penerbit,
                    harga    = :harga,
                    stok     = :stok,
                    cover_url = :cover_url,
                    deskripsi = :deskripsi
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':judul'     => $data['judul'],
            ':penulis'   => $data['penulis'],
            ':penerbit'  => $data['penerbit'],
            ':harga'     => $data['harga'],
            ':stok'      => $data['stok'],
            ':cover_url' => $data['cover_url'] ?? null,
            ':deskripsi' => $data['deskripsi'] ?? null,
            ':id'        => $id,
        ]);
    }

    // ─────────────────────────────────────────────
    // DELETE: Hapus buku berdasarkan ID
    // ─────────────────────────────────────────────
    public function delete(int $id): bool {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }

    // ─────────────────────────────────────────────
    // Helper: Hitung total buku
    // ─────────────────────────────────────────────
    public function count(): int {
        return (int) $this->db->query(
            "SELECT COUNT(*) FROM {$this->table}"
        )->fetchColumn();
    }
}
