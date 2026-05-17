<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Toko Buku Nusantara</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:     #1a1108;
            --cream:   #f7f1e8;
            --amber:   #c8821a;
            --amber-dark: #9e6512;
            --paper:   #fdf8f0;
            --warm-gray: #8a7968;
            --error:   #c0392b;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
        }

        /* Panel kiri — dekorasi */
        .panel-left {
            flex: 1;
            background: var(--ink);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(200,130,26,0.15) 0%, transparent 60%),
                radial-gradient(circle at 80% 20%, rgba(200,130,26,0.08) 0%, transparent 50%);
        }

        .brand-logo {
            position: relative;
            text-align: center;
        }

        .brand-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            display: block;
            filter: drop-shadow(0 0 30px rgba(200,130,26,0.4));
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: var(--cream);
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }

        .brand-tagline {
            font-size: 0.9rem;
            color: var(--amber);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .decorative-lines {
            position: absolute;
            bottom: 3rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            text-align: center;
        }

        .decorative-lines p {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: var(--warm-gray);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        /* Panel kanan — form */
        .panel-right {
            width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4rem 3.5rem;
            background: var(--paper);
        }

        .form-header {
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--ink);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--warm-gray);
            font-size: 0.9rem;
            font-weight: 300;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(138,121,104,0.25);
        }

        .divider-text {
            font-size: 0.75rem;
            color: var(--warm-gray);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .alert-error {
            background: rgba(192,57,43,0.08);
            border-left: 3px solid var(--error);
            padding: 0.8rem 1rem;
            border-radius: 0 6px 6px 0;
            color: var(--error);
            font-size: 0.88rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.4rem;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--warm-gray);
            margin-bottom: 0.5rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid rgba(138,121,104,0.3);
            border-radius: 8px;
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--ink);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-group input:focus {
            border-color: var(--amber);
            box-shadow: 0 0 0 3px rgba(200,130,26,0.12);
        }

        .btn-login {
            width: 100%;
            padding: 0.95rem;
            background: var(--ink);
            color: var(--cream);
            border: none;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: #2d1f0d;
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .demo-credentials {
            margin-top: 2rem;
            padding: 1rem 1.2rem;
            background: rgba(200,130,26,0.08);
            border-radius: 8px;
            border: 1px dashed rgba(200,130,26,0.35);
        }

        .demo-credentials h4 {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--amber-dark);
            font-weight: 500;
            margin-bottom: 0.6rem;
        }

        .demo-credentials table {
            width: 100%;
            font-size: 0.82rem;
            border-collapse: collapse;
        }

        .demo-credentials td {
            padding: 0.2rem 0.5rem;
            color: var(--ink);
        }

        .demo-credentials td:first-child {
            color: var(--warm-gray);
            width: 55px;
        }

        .demo-credentials code {
            background: rgba(0,0,0,0.06);
            padding: 0.1rem 0.4rem;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 0.85em;
        }

        @media (max-width: 768px) {
            .panel-left { display: none; }
            .panel-right { width: 100%; padding: 3rem 2rem; }
        }
    </style>
</head>
<body>

    <!-- Panel Kiri: Dekorasi Branding -->
    <div class="panel-left">
        <div class="brand-logo">
            <span class="brand-icon">📚</span>
            <h1 class="brand-name">Toko Buku<br>Nusantara</h1>
            <p class="brand-tagline">Sejak 1985 · Yogyakarta</p>
        </div>
        <div class="decorative-lines">
            <p>"Buku adalah jendela dunia,<br>dan membaca adalah kuncinya."</p>
        </div>
    </div>

    <!-- Panel Kanan: Form Login -->
    <div class="panel-right">
        <div class="form-header">
            <h2>Selamat Datang</h2>
            <p>Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">Login</span>
            <div class="divider-line"></div>
        </div>

        <!-- Tampilkan error jika ada (dari Controller) -->
        <?php if (!empty($error)): ?>
            <div class="alert-error">⚠ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Form dikirim ke gateway yang sama (login.php) via POST -->
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Masukkan username Anda"
                    value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password Anda"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn-login">Masuk ke Toko</button>
        </form>

        <!-- Info Kredensial Demo -->
        <div class="demo-credentials">
            <h4>🔑 Akun Demo</h4>
            <table>
                <tr>
                    <td>Admin:</td>
                    <td><code>admin</code> / <code>admin123</code></td>
                </tr>
                <tr>
                    <td>User:</td>
                    <td><code>user</code> / <code>user123</code></td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
