<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku — Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Style identik dengan tambah.php — di proyek nyata bisa pakai shared CSS file -->
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --ink: #1a1108;
            --cream: #f7f1e8;
            --amber: #c8821a;
            --amber-lt: rgba(200, 130, 26, 0.12);
            --paper: #fdf8f0;
            --warm-gray: #8a7968;
            --border: rgba(138, 121, 104, 0.2);
            --error: #c0392b;
            --sidebar-w: 240px;
        }

        body {
            background: #f0ebe2;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            display: flex;
            min-height: 100vh;
        }

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
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
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

        .sidebar-nav {
            flex: 1;
            padding: 1.2rem 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            padding: 0.75rem 1.5rem;
            color: rgba(247, 241, 232, 0.55);
            text-decoration: none;
            font-size: 0.88rem;
            transition: all .2s;
        }

        .nav-item:hover,
        .nav-item.active {
            color: var(--cream);
            background: rgba(200, 130, 26, 0.1);
            border-left: 2px solid var(--amber);
        }

        .nav-item span {
            font-size: 1.1rem;
        }

        .sidebar-logout {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
        }

        .btn-logout-sidebar {
            display: block;
            width: 100%;
            padding: 0.6rem;
            background: transparent;
            border: 1px solid rgba(192, 57, 43, 0.35);
            color: rgba(192, 57, 43, 0.8);
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            cursor: pointer;
            transition: all .2s;
        }

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
        }

        header p {
            font-size: 0.82rem;
            color: var(--warm-gray);
            margin-top: 0.15rem;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            color: var(--warm-gray);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all .2s;
        }

        .btn-back:hover {
            border-color: var(--amber);
            color: var(--amber);
        }

        main {
            padding: 2rem;
            max-width: 800px;
        }

        .form-card {
            background: var(--paper);
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-card-header {
            padding: 1.3rem 1.8rem;
            border-bottom: 1px solid var(--border);
            background: var(--amber-lt);
        }

        .form-card-header h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            color: var(--ink);
        }

        .form-body {
            padding: 1.8rem;
        }

        .errors {
            background: rgba(192, 57, 43, 0.07);
            border: 1px solid rgba(192, 57, 43, 0.2);
            border-radius: 8px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
        }

        .errors ul {
            list-style: none;
        }

        .errors li {
            color: var(--error);
            font-size: 0.85rem;
            padding: 0.2rem 0;
        }

        .errors li::before {
            content: '⚠ ';
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
        }

        .form-group {
            margin-bottom: 1.3rem;
        }

        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 0.45rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.92rem;
            color: var(--ink);
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(200, 130, 26, 0.1);
        }

        .form-group textarea {
            min-height: 90px;
            resize: vertical;
        }

        .hint {
            font-size: 0.75rem;
            color: var(--warm-gray);
            margin-top: 0.3rem;
        }

        .cover-preview {
            margin-top: 0.7rem;
            width: 80px;
            height: 108px;
            border: 1px dashed var(--border);
            border-radius: 6px;
            overflow: hidden;
        }

        .cover-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-footer {
            padding: 1.3rem 1.8rem;
            border-top: 1px solid var(--border);
            background: rgba(247, 241, 232, 0.5);
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
        }

        .btn-cancel {
            padding: 0.65rem 1.4rem;
            border: 1.5px solid var(--border);
            border-radius: 7px;
            background: transparent;
            color: var(--warm-gray);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all .2s;
        }

        .btn-cancel:hover {
            border-color: var(--warm-gray);
            color: var(--ink);
        }

        .btn-simpan {
            padding: 0.65rem 1.8rem;
            background: var(--ink);
            color: var(--cream);
            border: none;
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-simpan:hover {
            background: #2d1f0d;
        }
    </style>
</head>

<body>

    <aside>
        <div class="sidebar-brand">
            <h1>📚 Toko Buku<br>Nusantara</h1>
            <p>Admin Panel</p>
        </div>
        <nav class="sidebar-nav">
            <a href="admin.php" class="nav-item">
                <span>📋</span> Manajemen Buku
            </a>
            <a href="admin.php?aksi=ubah&id=<?= $data['id'] ?>" class="nav-item active">
                <span>✏</span> Edit Buku
            </a>
        </nav>
        <div class="sidebar-logout">
            <form method="POST" action="logout.php">
                <button type="submit" class="btn-logout-sidebar">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header>
            <div>
                <h2>Edit Data Buku</h2>
                <p>Mengubah: <em><?= htmlspecialchars($data['judul'] ?? '') ?></em></p>
            </div>
            <a href="admin.php" class="btn-back">← Kembali</a>
        </header>

        <main>
            <div class="form-card">
                <div class="form-card-header">
                    <h3>✏ Formulir Edit Buku</h3>
                </div>

                <div class="form-body">
                    <?php if (!empty($errors)): ?>
                        <div class="errors">
                            <ul>
                                <?php foreach ($errors as $e): ?>
                                    <li><?= htmlspecialchars($e) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- POST ke admin.php?aksi=ubah&id=X — Controller yang menangani -->
                    <form id="edit-form" method="POST"
                        action="admin.php?aksi=ubah&id=<?= (int) $data['id'] ?>">

                        <div class="form-group">
                            <label for="judul">Judul Buku *</label>
                            <input type="text" id="judul" name="judul"
                                value="<?= htmlspecialchars($data['judul'] ?? '') ?>"
                                required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="penulis">Penulis *</label>
                                <input type="text" id="penulis" name="penulis"
                                    value="<?= htmlspecialchars($data['penulis'] ?? '') ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit *</label>
                                <input type="text" id="penerbit" name="penerbit"
                                    value="<?= htmlspecialchars($data['penerbit'] ?? '') ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="harga">Harga (Rp) *</label>
                                <input type="number" id="harga" name="harga"
                                    value="<?= htmlspecialchars($data['harga'] ?? '') ?>"
                                    min="0" step="1000" required>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok *</label>
                                <input type="number" id="stok" name="stok"
                                    value="<?= htmlspecialchars($data['stok'] ?? '0') ?>"
                                    min="0" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cover_url">URL Gambar Cover</label>
                            <input type="url" id="cover_url" name="cover_url"
                                value="<?= htmlspecialchars($data['cover_url'] ?? '') ?>"
                                oninput="updatePreview(this.value)">
                            <p class="hint">Opsional. Kosongkan jika tidak ingin mengubah cover.</p>
                            <div class="cover-preview" id="cover-preview"
                                style="<?= empty($data['cover_url']) ? 'display:none' : '' ?>">
                                <img id="cover-img"
                                    src="<?= htmlspecialchars($data['cover_url'] ?? '') ?>"
                                    alt="Preview">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Buku</label>
                            <textarea id="deskripsi" name="deskripsi"><?= htmlspecialchars($data['deskripsi'] ?? '') ?></textarea>
                        </div>

                    </form>
                </div>

                <div class="form-footer">
                    <a href="admin.php" class="btn-cancel">Batal</a>
                    <button type="submit" form="edit-form" class="btn-simpan">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        function updatePreview(url) {
            const preview = document.getElementById('cover-preview');
            const img = document.getElementById('cover-img');
            if (url.startsWith('http')) {
                img.src = url;
                preview.style.display = 'block';
                img.onerror = () => preview.style.display = 'none';
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>