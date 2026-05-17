-- ============================================================
-- TOKO BUKU MULTIROLE — Setup Database
-- Step 2: Jalankan SQL ini di phpMyAdmin atau MySQL CLI
-- ============================================================

-- 1. Buat database
CREATE DATABASE IF NOT EXISTS toko_buku
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE toko_buku;

-- 2. Tabel users (admin & user biasa)
CREATE TABLE IF NOT EXISTS users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nama     VARCHAR(100)        NOT NULL,
    username VARCHAR(50)         NOT NULL UNIQUE,
    password VARCHAR(255)        NOT NULL,  -- Di-hash dengan password_hash()
    role     ENUM('admin','user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabel buku
CREATE TABLE IF NOT EXISTS buku (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    judul      VARCHAR(200)   NOT NULL,
    penulis    VARCHAR(150)   NOT NULL,
    penerbit   VARCHAR(150)   NOT NULL,
    harga      DECIMAL(12, 2) NOT NULL,
    stok       INT            NOT NULL DEFAULT 0,
    cover_url  VARCHAR(500)   NULL,        -- URL gambar sampul buku
    deskripsi  TEXT           NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- DATA AWAL (Seeding)
-- ============================================================

-- Insert 2 user default (password: admin123 & user123)
-- Gunakan password_hash('admin123', PASSWORD_DEFAULT) pada PHP
-- Nilai hash di bawah adalah hasil dari fungsi tersebut
INSERT INTO users (nama, username, password, role) VALUES
('Administrator', 'admin', '$2y$12$EFioTi6MNFXkQaqgMl7MjuWm7JC9ZbEHtWsI6dB.W9HPmzlQXPMaK', 'admin'),
('Budi Santoso',  'user',  '$2y$12$kB2Vu6N3cM9tGt0oPYbfBuYMmqKLKqtZXHqXTpJTJTqQ0MKq9YoOC', 'user');

-- Insert beberapa buku contoh
INSERT INTO buku (judul, penulis, penerbit, harga, stok, cover_url, deskripsi) VALUES
('Laskar Pelangi',           'Andrea Hirata',    'Bentang Pustaka',   89000,  15, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1327867636i/1362193.jpg', 'Novel yang mengisahkan perjuangan sekelompok anak di Belitung untuk mendapatkan pendidikan.'),
('Bumi Manusia',             'Pramoedya Ananta Toer', 'Lentera Dipantara', 120000, 8, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1388666828i/272357.jpg', 'Masterpiece sastra Indonesia tentang perjuangan dan kolonialisme.'),
('Atomic Habits',            'James Clear',       'Gramedia',          155000, 20, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1655988385i/40121378.jpg', 'Panduan praktis membangun kebiasaan baik dan meninggalkan kebiasaan buruk.'),
('Filosofi Teras',           'Henry Manampiring', 'Kompas',            98000,  12, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1560671850i/45892207.jpg', 'Filsafat Yunani-Romawi kuno untuk mental tangguh masa kini.'),
('The Psychology of Money',  'Morgan Housel',     'Gramedia',          139000, 18, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1581527774i/41881472.jpg', 'Pelajaran abadi tentang kekayaan, keserakahan, dan kebahagiaan.'),
('Dune',                     'Frank Herbert',     'Gramedia',          175000,  5, 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1555447414i/44767458.jpg', 'Epik fiksi ilmiah terbesar sepanjang masa di planet Arrakis.');

-- ============================================================
-- NOTE: Password default untuk login:
--   admin → username: admin   | password: admin123
--   user  → username: user    | password: user123
--
-- Jika hash di atas tidak cocok, jalankan script PHP berikut
-- untuk generate hash baru dan update tabel users:
--
-- <?php
-- echo password_hash('admin123', PASSWORD_DEFAULT); // untuk admin
-- echo password_hash('user123', PASSWORD_DEFAULT);  // untuk user
-- ?>
-- ============================================================
