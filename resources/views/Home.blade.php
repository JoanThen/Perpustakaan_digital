<!DOCTYPE html>
<html lang="id">
<head>
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0d0d0d;
            --paper: #f5f0e8;
            --cream: #faf7f2;
            --accent: #c8622a;
            --accent-light: #e8956a;
            --muted: #8a8070;
            --border: rgba(13,13,13,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 22px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(245, 240, 232, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            transition: padding 0.3s;
        }

        .navbar.scrolled {
            padding: 15px 60px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.3px;
        }

        .navbar-brand span {
            color: var(--accent);
        }

        .navbar-links {
            display: flex;
            gap: 32px;
            align-items: center;
        }

        .navbar-links a {
            font-size: 14px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            letter-spacing: 0.3px;
            transition: color 0.2s;
        }

        .navbar-links a:hover { color: var(--ink); }

        .navbar-links a.btn-nav {
            background: var(--ink);
            color: var(--cream);
            padding: 9px 22px;
            border-radius: 100px;
            font-size: 13px;
            transition: background 0.2s;
        }

        .navbar-links a.btn-nav:hover {
            background: var(--accent);
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 120px 60px 80px;
            gap: 60px;
            position: relative;
        }

        .hero::after {
            content: '';
            position: absolute;
            right: 0; top: 0; bottom: 0;
            width: 42%;
            background: var(--paper);
            z-index: 0;
        }

        .hero-text {
            position: relative;
            z-index: 1;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 24px;
        }

        .hero-eyebrow::before {
            content: '';
            display: block;
            width: 28px;
            height: 1px;
            background: var(--accent);
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 62px;
            font-weight: 900;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 24px;
            color: var(--ink);
        }

        .hero h1 em {
            font-style: italic;
            color: var(--accent);
        }

        .hero-desc {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.75;
            max-width: 440px;
            margin-bottom: 44px;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn-primary {
            display: inline-block;
            padding: 14px 32px;
            background: var(--ink);
            color: var(--cream);
            text-decoration: none;
            border-radius: 100px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.2px;
            transition: all 0.25s;
        }

        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(200, 98, 42, 0.3);
        }

        .btn-ghost {
            display: inline-block;
            padding: 14px 24px;
            color: var(--ink);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-bottom: 1.5px solid var(--ink);
            transition: all 0.25s;
            letter-spacing: 0.2px;
        }

        .btn-ghost:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        /* Book illustration */
        .hero-visual {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
        }

        .book-stack {
            position: relative;
            width: 280px;
            height: 360px;
        }

        .book {
            position: absolute;
            border-radius: 4px 12px 12px 4px;
            box-shadow: 4px 8px 24px rgba(0,0,0,0.12);
        }

        .book-1 {
            width: 200px; height: 280px;
            background: linear-gradient(135deg, #c8622a, #e8956a);
            top: 40px; left: 40px;
            transform: rotate(-6deg);
        }

        .book-2 {
            width: 185px; height: 260px;
            background: linear-gradient(135deg, #2a4858, #3d6b82);
            top: 60px; left: 60px;
            transform: rotate(2deg);
        }

        .book-3 {
            width: 170px; height: 240px;
            background: linear-gradient(135deg, #5c4a2a, #8a7040);
            top: 75px; left: 72px;
            transform: rotate(-1deg);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .book-3::after {
            content: '📖';
            font-size: 48px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .book-spine {
            position: absolute;
            left: 0; top: 8px; bottom: 8px;
            width: 14px;
            background: rgba(0,0,0,0.2);
            border-radius: 4px 0 0 4px;
        }

        /* Decorative numbers */
        .deco-number {
            position: absolute;
            font-family: 'Playfair Display', serif;
            font-size: 160px;
            font-weight: 900;
            color: rgba(13,13,13,0.04);
            line-height: 1;
            pointer-events: none;
            user-select: none;
        }

        .deco-number-1 { top: 60px; right: -20px; }

        /* ── STATS ── */
        .stats {
            background: var(--ink);
            padding: 70px 60px;
        }

        .stats-inner {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            overflow: hidden;
        }

        .stat-item {
            background: var(--ink);
            padding: 48px 40px;
            text-align: center;
            transition: background 0.25s;
        }

        .stat-item:hover {
            background: #1a1a1a;
        }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 52px;
            font-weight: 900;
            color: var(--accent-light);
            line-height: 1;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 13px;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            font-weight: 500;
        }

        /* ── FEATURES ── */
        .features {
            padding: 100px 60px;
            background: var(--cream);
        }

        .features-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 64px;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 44px;
            font-weight: 700;
            letter-spacing: -1.5px;
            line-height: 1.15;
        }

        .features-header p {
            font-size: 15px;
            color: var(--muted);
            max-width: 280px;
            line-height: 1.6;
            text-align: right;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            max-width: 1100px;
            margin: 0 auto;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
        }

        .feature-card {
            background: var(--cream);
            padding: 44px 36px;
            transition: background 0.25s;
        }

        .feature-card:hover {
            background: var(--paper);
        }

        .feature-icon {
            font-size: 32px;
            margin-bottom: 20px;
            display: block;
        }

        .feature-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: -0.3px;
        }

        .feature-card p {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
        }

        /* ── FOOTER ── */
        .footer {
            background: var(--paper);
            border-top: 1px solid var(--border);
            padding: 48px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--ink);
        }

        .footer-brand span { color: var(--accent); }

        .footer-copy {
            font-size: 13px;
            color: var(--muted);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-eyebrow  { animation: fadeUp 0.6s ease 0.1s both; }
        .hero h1       { animation: fadeUp 0.6s ease 0.2s both; }
        .hero-desc     { animation: fadeUp 0.6s ease 0.3s both; }
        .hero-actions  { animation: fadeUp 0.6s ease 0.4s both; }
        .hero-visual   { animation: fadeUp 0.8s ease 0.3s both; }

        .book-1 { animation: float1 6s ease-in-out infinite; }
        .book-2 { animation: float2 7s ease-in-out infinite 0.5s; }
        .book-3 { animation: float1 5.5s ease-in-out infinite 1s; }

        @keyframes float1 {
            0%, 100% { transform: rotate(-6deg) translateY(0); }
            50% { transform: rotate(-6deg) translateY(-12px); }
        }
        @keyframes float2 {
            0%, 100% { transform: rotate(2deg) translateY(0); }
            50% { transform: rotate(2deg) translateY(-8px); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .navbar, .navbar.scrolled { padding: 18px 24px; }

            .hero {
                grid-template-columns: 1fr;
                padding: 110px 24px 60px;
                text-align: center;
            }

            .hero::after { display: none; }

            .hero h1 { font-size: 42px; }

            .hero-eyebrow { justify-content: center; }
            .hero-desc { margin: 0 auto 36px; }
            .hero-actions { justify-content: center; flex-wrap: wrap; }

            .hero-visual { height: 300px; }
            .book-stack { transform: scale(0.8); }

            .stats { padding: 50px 24px; }
            .stats-inner { grid-template-columns: 1fr; gap: 0; border-radius: 12px; }

            .features { padding: 70px 24px; }
            .features-header { flex-direction: column; gap: 16px; align-items: flex-start; }
            .features-header p { text-align: left; }
            .features-grid { grid-template-columns: 1fr; }

            .footer { flex-direction: column; gap: 16px; text-align: center; padding: 40px 24px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="navbar-brand">Perpustakaan<span>.</span></div>
    <div class="navbar-links">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
            @endif
            <a href="{{ route('profile.edit') }}">Profil</a>
        @else
            <a href="{{ route('login') }}" class="btn-nav">Masuk</a>
        @endauth
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-text">
        <div class="hero-eyebrow">Sistem Manajemen Buku</div>
        <h1>Perpustakaan<br>yang <em>Modern</em><br>& Efisien</h1>
        <p class="hero-desc">
            Kelola koleksi buku, peminjaman, dan data pengguna dalam satu platform yang bersih dan mudah digunakan.
        </p>
        <div class="hero-actions">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Masuk Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Mulai Sekarang</a>
                <a href="{{ route('register') }}" class="btn-ghost">Daftar Gratis</a>
            @endauth
        </div>
    </div>

    <div class="hero-visual">
        <div class="deco-number deco-number-1">B</div>
        <div class="book-stack">
            <div class="book book-1"><div class="book-spine"></div></div>
            <div class="book book-2"><div class="book-spine"></div></div>
            <div class="book book-3"><div class="book-spine"></div></div>
        </div>
    </div>
</section>

<!-- STATISTIK -->
<section class="stats">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-num">{{ $totalBuku }}</div>
            <div class="stat-label">Judul Buku</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $totalStok }}</div>
            <div class="stat-label">Total Stok</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $totalDipinjam }}</div>
            <div class="stat-label">Sedang Dipinjam</div>
        </div>
    </div>
</section>

<script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 40);
    });
</script>

</body>
</html>