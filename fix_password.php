<?php
/**
 * fix_password.php
 * Taruh file ini di folder toko-buku/, buka di browser SEKALI,
 * lalu HAPUS file ini setelah selesai.
 *
 * Contoh: http://localhost/toko-buku/fix_password.php
 */

// Generate hash yang benar di server Anda sendiri
$hash_admin = password_hash('admin123', PASSWORD_DEFAULT);
$hash_user  = password_hash('user123',  PASSWORD_DEFAULT);

echo "<pre>";
echo "Hash admin123 : " . $hash_admin . "\n";
echo "Hash user123  : " . $hash_user  . "\n";
echo "</pre>";

// ── Coba langsung update ke database ──
require_once __DIR__ . '/config/Database.php';

try {
    $db = (new Database())->getConnection();

    $db->prepare("UPDATE users SET password = ? WHERE username = 'admin'")->execute([$hash_admin]);
    $db->prepare("UPDATE users SET password = ? WHERE username = 'user'")->execute([$hash_user]);

    echo "<p style='color:green;font-weight:bold'>✅ Password berhasil diupdate! Silakan login sekarang.</p>";
    echo "<p><a href='login.php'>→ Ke halaman login</a></p>";
    echo "<p style='color:red'><strong>⚠ Hapus file fix_password.php ini sekarang!</strong></p>";

} catch (Exception $e) {
    echo "<p style='color:orange'>⚠ Database belum tersambung, tapi hash sudah digenerate di atas.</p>";
    echo "<p>Jalankan SQL ini secara manual di phpMyAdmin:</p>";
    echo "<pre style='background:#f0f0f0;padding:1rem'>";
    echo "UPDATE users SET password = '" . $hash_admin . "' WHERE username = 'admin';\n";
    echo "UPDATE users SET password = '" . $hash_user  . "' WHERE username = 'user';\n";
    echo "</pre>";
}