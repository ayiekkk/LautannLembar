<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku — Toko Buku Nusantara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
            --shadow:    0 4px 24px rgba(26,17,8,0.08);
        }

        body {
            background: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        nav {
            background: var(--ink);
            padding: 0 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        }

        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: var(--cream);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .nav-greeting {
            font-size: 0.85rem;
            color: rgba(247,241,232,0.6);
        }

        .nav-greeting strong {
            color: var(--amber);
        }

        .btn-logout {
            padding: 0.45rem 1.1rem;
            border: 1px solid rgba(200,130,26,0.4);
            border-radius: 6px;
            color: var(--amber);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            transition: all 0.2s;
            background: transparent;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: var(--amber);
            color: var(--ink);
            border-color: var(--amber);
        }

        /* ── HERO BANNER ── */
        .hero {
            background: linear-gradient(135deg, #2d1f0d 0%, var(--ink) 60%);
            padding: 4rem 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 50%, rgba(200,130,26,0.18) 0%, transparent 65%);
        }

        .hero-content { position: relative; }

        .hero-subtitle {
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--amber);
            font-weight: 500;
            margin-bottom: 0.8rem;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            color: var(--cream);
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .hero p {
            color: rgba(247,241,232,0.65);
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
            font-weight: 300;
        }

        /* ── KONTEN UTAMA ── */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .section-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--ink);
        }

        .book-count {
            font-size: 0.82rem;
            color: var(--warm-gray);
            background: var(--amber-lt);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
        }

        /* ── GRID BUKU ── */
        .buku-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.8rem;
        }

        .buku-card {
            background: var(--paper);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .buku-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(26,17,8,0.15);
        }

        .buku-cover {
            aspect-ratio: 3/4;
            overflow: hidden;
            background: linear-gradient(135deg, #e8dcc8, #d4c4a8);
            position: relative;
        }

        .buku-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .buku-card:hover .buku-cover img {
            transform: scale(1.04);
        }

        /* Fallback jika gambar tidak ada */
        .buku-cover-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem;
            text-align: center;
        }

        .buku-cover-placeholder span {
            font-size: 3rem;
        }

        .buku-cover-placeholder p {
            font-family: 'Playfair Display', serif;
            font-size: 0.85rem;
            color: var(--warm-gray);
            line-height: 1.3;
        }

        .badge-stok {
            position: absolute;
            top: 0.7rem;
            right: 0.7rem;
            font-size: 0.7rem;
            font-weight: 500;
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            background: var(--ink);
            color: var(--amber);
            letter-spacing: 0.04em;
        }

        .badge-stok.habis {
            background: rgba(192,57,43,0.85);
            color: white;
        }

        .buku-info {
            padding: 1rem 1.1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .buku-penerbit {
            font-size: 0.72rem;
            color: var(--amber);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 0.35rem;
        }

        .buku-judul {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--ink);
            line-height: 1.3;
            margin-bottom: 0.3rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .buku-penulis {
            font-size: 0.8rem;
            color: var(--warm-gray);
            margin-bottom: 0.8rem;
            font-weight: 300;
        }

        .buku-footer {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0.8rem;
            border-top: 1px solid var(--border);
        }

        .buku-harga {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--ink);
        }

        .btn-beli {
            padding: 0.4rem 1rem;
            background: var(--amber);
            color: white;
            border: none;
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-beli:hover { background: #a86e15; }

        .btn-beli:disabled {
            background: rgba(138,121,104,0.3);
            color: var(--warm-gray);
            cursor: not-allowed;
        }

        /* ── KOSONG ── */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--warm-gray);
        }

        .empty-state span { font-size: 4rem; display: block; margin-bottom: 1rem; }

        /* ── FOOTER ── */
        footer {
            background: var(--ink);
            color: rgba(247,241,232,0.5);
            text-align: center;
            padding: 1.5rem;
            font-size: 0.8rem;
            margin-top: 4rem;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <a href="index.php" class="nav-brand">📚 Toko Buku Nusantara</a>
        <div class="nav-user">
            <span class="nav-greeting">Halo, <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong></span>
            <form method="POST" action="logout.php" style="display:inline">
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-content">
            <p class="hero-subtitle">✦ Koleksi Pilihan ✦</p>
            <h1>Temukan Buku<br><em>Impian Anda</em></h1>
            <p>Ribuan judul buku terbaik dari penulis lokal dan internasional</p>
        </div>
    </div>

    <!-- KONTEN UTAMA -->
    <main>
        <div class="section-header">
            <h2>Katalog Buku</h2>
            <span class="book-count"><?= count($daftar_buku) ?> judul tersedia</span>
        </div>

        <?php if (empty($daftar_buku)): ?>
            <!-- State kosong jika tidak ada buku -->
            <div class="empty-state">
                <span>📦</span>
                <p>Belum ada buku dalam katalog. Silakan hubungi admin.</p>
            </div>
        <?php else: ?>
            <!-- Grid Kartu Buku — View HANYA menampilkan $daftar_buku dari Controller -->
            <div class="buku-grid">
                <?php foreach ($daftar_buku as $buku): ?>
                    <div class="buku-card">

                        <!-- Cover Buku -->
                        <div class="buku-cover">
                            <?php if (!empty($buku['cover_url'])): ?>
                                <img
                                    src="<?= htmlspecialchars($buku['cover_url']) ?>"
                                    alt="Cover <?= htmlspecialchars($buku['judul']) ?>"
                                    loading="lazy"
                                    onerror="this.parentElement.innerHTML='<div class=\'buku-cover-placeholder\'><span>📖</span><p><?= addslashes(htmlspecialchars($buku['judul'])) ?></p></div>'"
                                >
                            <?php else: ?>
                                <div class="buku-cover-placeholder">
                                    <span>📖</span>
                                    <p><?= htmlspecialchars($buku['judul']) ?></p>
                                </div>
                            <?php endif; ?>

                            <!-- Badge Stok -->
                            <span class="badge-stok <?= $buku['stok'] <= 0 ? 'habis' : '' ?>">
                                <?= $buku['stok'] > 0 ? "Stok: {$buku['stok']}" : 'Habis' ?>
                            </span>
                        </div>

                        <!-- Info Buku -->
                        <div class="buku-info">
                            <p class="buku-penerbit"><?= htmlspecialchars($buku['penerbit']) ?></p>
                            <h3 class="buku-judul"><?= htmlspecialchars($buku['judul']) ?></h3>
                            <p class="buku-penulis">oleh <?= htmlspecialchars($buku['penulis']) ?></p>

                            <div class="buku-footer">
                                <span class="buku-harga">
                                    Rp <?= number_format($buku['harga'], 0, ',', '.') ?>
                                </span>
                                <button
                                    class="btn-beli"
                                    <?= $buku['stok'] <= 0 ? 'disabled' : '' ?>
                                    onclick="alert('Fitur pembelian segera hadir! 🛒')"
                                >
                                    <?= $buku['stok'] > 0 ? 'Beli' : 'Habis' ?>
                                </button>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <p>© <?= date('Y') ?> Toko Buku Nusantara · Yogyakarta · PHP MVC Native</p>
    </footer>

</body>
</html>
