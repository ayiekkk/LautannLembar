<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Toko Buku Nusantara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #1a1108;
            --cream:     #f7f1e8;
            --amber:     #c8821a;
            --amber-lt:  rgba(200,130,26,0.12);
            --paper:     #fdf8f0;
            --warm-gray: #8a7968;
            --border:    rgba(138,121,104,0.2);
            --success:   #27ae60;
            --error:     #c0392b;
            --sidebar-w: 240px;
        }

        body {
            background: #f0ebe2;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        aside {
            width: var(--sidebar-w);
            background: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
        }

        .sidebar-brand {
            padding: 1.8rem 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-brand h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--cream);
            line-height: 1.2;
        }

        .sidebar-brand p {
            font-size: 0.72rem;
            color: var(--amber);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-top: 0.3rem;
        }

        .sidebar-admin {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            background: var(--amber-lt);
            border-radius: 50%;
            border: 1.5px solid rgba(200,130,26,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .admin-name { font-size: 0.85rem; color: var(--cream); font-weight: 500; }
        .admin-role { font-size: 0.72rem; color: var(--warm-gray); }

        .sidebar-nav {
            flex: 1;
            padding: 1.2rem 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.75rem 1.5rem;
            color: rgba(247,241,232,0.55);
            text-decoration: none;
            font-size: 0.88rem;
            transition: all 0.2s;
        }

        .nav-item:hover, .nav-item.active {
            color: var(--cream);
            background: rgba(200,130,26,0.1);
            border-left: 2px solid var(--amber);
        }

        .nav-item span { font-size: 1.1rem; }

        .sidebar-logout {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .btn-logout-sidebar {
            display: block;
            width: 100%;
            padding: 0.6rem;
            background: transparent;
            border: 1px solid rgba(192,57,43,0.35);
            color: rgba(192,57,43,0.8);
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout-sidebar:hover {
            background: rgba(192,57,43,0.1);
            border-color: rgba(192,57,43,0.6);
        }

        /* ── MAIN CONTENT ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background: var(--paper);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--ink);
        }

        header p { font-size: 0.82rem; color: var(--warm-gray); margin-top: 0.15rem; }

        .btn-tambah {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.3rem;
            background: var(--ink);
            color: var(--cream);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-tambah:hover { background: #2d1f0d; }

        main { padding: 2rem; flex: 1; }

        /* ── STATS CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--paper);
            border-radius: 10px;
            padding: 1.3rem 1.5rem;
            border: 1px solid var(--border);
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .stat-icon { font-size: 1.8rem; margin-bottom: 0.5rem; }
        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--ink);
        }
        .stat-label { font-size: 0.78rem; color: var(--warm-gray); margin-top: 0.2rem; }

        /* ── FLASH MESSAGE ── */
        .flash {
            padding: 0.85rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .flash.success {
            background: rgba(39,174,96,0.1);
            border: 1px solid rgba(39,174,96,0.3);
            color: #1a7a43;
        }

        .flash.error {
            background: rgba(192,57,43,0.08);
            border: 1px solid rgba(192,57,43,0.25);
            color: var(--error);
        }

        /* ── TABEL ── */
        .table-wrapper {
            background: var(--paper);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.88rem;
        }

        thead {
            background: var(--ink);
        }

        thead th {
            color: var(--cream);
            font-weight: 500;
            font-size: 0.75rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 0.9rem 1.2rem;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(200,130,26,0.04); }

        td {
            padding: 0.9rem 1.2rem;
            vertical-align: middle;
        }

        .td-cover img {
            width: 40px;
            height: 54px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--border);
        }

        .td-cover .no-cover {
            width: 40px;
            height: 54px;
            background: var(--amber-lt);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .td-judul strong { display: block; color: var(--ink); }
        .td-judul span { font-size: 0.78rem; color: var(--warm-gray); }

        .badge-stok {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-stok.ok { background: rgba(39,174,96,0.1); color: #1a7a43; }
        .badge-stok.low { background: rgba(200,130,26,0.15); color: var(--amber-dark, #a06510); }
        .badge-stok.habis { background: rgba(192,57,43,0.1); color: var(--error); }

        .td-actions { display: flex; gap: 0.5rem; }

        .btn-edit {
            padding: 0.35rem 0.9rem;
            background: var(--amber-lt);
            color: var(--amber);
            border: 1px solid rgba(200,130,26,0.25);
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .btn-edit:hover { background: var(--amber); color: white; }

        .btn-hapus {
            padding: 0.35rem 0.9rem;
            background: rgba(192,57,43,0.08);
            color: var(--error);
            border: 1px solid rgba(192,57,43,0.2);
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 500;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.15s;
        }

        .btn-hapus:hover { background: var(--error); color: white; }

        .empty-row td {
            text-align: center;
            padding: 3rem;
            color: var(--warm-gray);
            font-style: italic;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside>
        <div class="sidebar-brand">
            <h1>📚 Toko Buku<br>Nusantara</h1>
            <p>Admin Panel</p>
        </div>

        <div class="sidebar-admin">
            <div class="admin-avatar">👤</div>
            <div>
                <p class="admin-name"><?= htmlspecialchars($_SESSION['nama']) ?></p>
                <p class="admin-role">Administrator</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="admin.php" class="nav-item active">
                <span>📋</span> Manajemen Buku
            </a>
            <a href="index.php" class="nav-item" target="_blank">
                <span>🛒</span> Lihat Toko
            </a>
        </nav>

        <div class="sidebar-logout">
            <form method="POST" action="logout.php">
                <button type="submit" class="btn-logout-sidebar">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-wrapper">
        <header>
            <div>
                <h2>Manajemen Buku</h2>
                <p>Kelola katalog buku toko Anda</p>
            </div>
            <a href="admin.php?aksi=tambah" class="btn-tambah">+ Tambah Buku</a>
        </header>

        <main>
            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <div class="stat-value"><?= $total_buku ?></div>
                    <div class="stat-label">Total Judul Buku</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <div class="stat-value">
                        <?= array_sum(array_column($daftar_buku, 'stok')) ?>
                    </div>
                    <div class="stat-label">Total Unit Stok</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-value">
                        <?= count(array_filter($daftar_buku, fn($b) => $b['stok'] > 0)) ?>
                    </div>
                    <div class="stat-label">Buku Tersedia</div>
                </div>
            </div>

            <!-- Flash Message -->
            <?php if ($pesan): ?>
                <div class="flash <?= $pesan['type'] ?>">
                    <?= $pesan['type'] === 'success' ? '✓' : '⚠' ?>
                    <?= htmlspecialchars($pesan['text']) ?>
                </div>
            <?php endif; ?>

            <!-- Tabel Buku -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Judul & Penulis</th>
                            <th>Penerbit</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftar_buku)): ?>
                            <tr class="empty-row">
                                <td colspan="7">Belum ada data buku. Silakan tambahkan buku baru.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftar_buku as $i => $buku): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td class="td-cover">
                                        <?php if (!empty($buku['cover_url'])): ?>
                                            <img src="<?= htmlspecialchars($buku['cover_url']) ?>"
                                                 alt="" loading="lazy"
                                                 onerror="this.outerHTML='<div class=\'no-cover\'>📖</div>'">
                                        <?php else: ?>
                                            <div class="no-cover">📖</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="td-judul">
                                        <strong><?= htmlspecialchars($buku['judul']) ?></strong>
                                        <span><?= htmlspecialchars($buku['penulis']) ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                                    <td>Rp <?= number_format($buku['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <?php
                                            $stok = (int) $buku['stok'];
                                            $kelas = $stok <= 0 ? 'habis' : ($stok <= 3 ? 'low' : 'ok');
                                        ?>
                                        <span class="badge-stok <?= $kelas ?>"><?= $stok ?> unit</span>
                                    </td>
                                    <td>
                                        <div class="td-actions">
                                            <a href="admin.php?aksi=ubah&id=<?= $buku['id'] ?>" class="btn-edit">✏ Edit</a>
                                            <!-- Form hapus menggunakan POST untuk keamanan -->
                                            <form method="POST" action="admin.php?aksi=hapus"
                                                  onsubmit="return confirm('Yakin ingin menghapus buku \'<?= addslashes(htmlspecialchars($buku['judul'])) ?>\'?')">
                                                <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                                                <button type="submit" class="btn-hapus">🗑 Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>
