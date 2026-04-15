<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0d0d0d;
            --paper: #f5f0e8;
            --cream: #faf7f2;
            --accent: #c8622a;
            --accent-light: #e8956a;
            --muted: #8a8070;
            --border: rgba(13,13,13,0.09);
            --sidebar-w: 240px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0ebe0;
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── SIDEBAR (tidak diubah) ── */
        .sidebar {
            position: fixed;
            left: 0; top: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--ink);
            display: flex; flex-direction: column;
            z-index: 50;
        }

        .sidebar-brand { padding: 28px 24px 24px; border-bottom: 1px solid rgba(255,255,255,0.07); }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px; font-weight: 700;
            color: white; text-decoration: none; display: block;
        }
        .sidebar-brand-name span { color: var(--accent-light); }

        .sidebar-brand-sub {
            font-size: 11px; color: rgba(255,255,255,0.3);
            letter-spacing: 1px; text-transform: uppercase; margin-top: 3px;
        }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section {
            font-size: 10px; font-weight: 500; letter-spacing: 1.5px;
            text-transform: uppercase; color: rgba(255,255,255,0.25); padding: 16px 12px 8px;
        }

        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: 8px;
            font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.5);
            text-decoration: none; transition: all 0.2s; margin-bottom: 2px;
        }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-link:hover { background: rgba(255,255,255,0.07); color: white; }
        .sidebar-link.active { background: var(--accent); color: white; }

        .sidebar-user { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
        .sidebar-user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }

        .avatar {
            width: 34px; height: 34px; background: var(--accent);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: white; flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 13px; font-weight: 500; color: white; line-height: 1.2; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.35); }

        .btn-logout {
            width: 100%; padding: 9px;
            background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            gap: 6px; transition: all 0.2s;
        }
        .btn-logout svg { width: 14px; height: 14px; }
        .btn-logout:hover { background: rgba(200,98,42,0.2); color: var(--accent-light); border-color: rgba(200,98,42,0.3); }

        /* ── MAIN ── */
        .main { margin-left: var(--sidebar-w); min-height: 100vh; }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--paper);
            border-bottom: 1px solid var(--border);
            padding: 0 36px;
            display: flex; justify-content: space-between; align-items: center;
            height: 72px;
            position: sticky; top: 0; z-index: 40;
        }

        .topbar-left { display: flex; align-items: center; gap: 14px; }

        .topbar-greeting {
            font-size: 11px; color: var(--muted);
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 900; letter-spacing: -0.6px; line-height: 1;
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-date-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 7px 14px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 100px; font-size: 12px; color: var(--muted);
        }
        .topbar-date-pill svg { width: 13px; height: 13px; stroke: var(--muted); }

        .notif-btn {
            position: relative; background: var(--cream);
            border: 1px solid var(--border); cursor: pointer;
            color: var(--muted); padding: 8px; border-radius: 10px;
            transition: all 0.2s; display: flex; align-items: center;
        }
        .notif-btn:hover { color: var(--ink); border-color: rgba(13,13,13,0.2); background: white; }
        .notif-btn svg { width: 16px; height: 16px; display: block; }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 6px; height: 6px;
            background: var(--accent); border-radius: 50%;
            border: 1.5px solid var(--paper);
        }

        /* ── HERO BAND ── */
        .hero-band {
            background: var(--ink);
            padding: 28px 36px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 20px;
        }

        .hero-left {}

        .hero-welcome {
            font-size: 11px; color: rgba(255,255,255,0.4);
            text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 6px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px; font-weight: 900; color: white;
            letter-spacing: -0.8px; line-height: 1.1;
        }

        .hero-title span { color: var(--accent-light); }

        .hero-sub {
            font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 6px;
        }

        .hero-right { display: flex; gap: 8px; }

        .hero-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 18px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500;
            text-decoration: none; transition: all 0.2s; cursor: pointer; border: none;
        }
        .hero-btn svg { width: 13px; height: 13px; }
        .hero-btn-primary { background: var(--accent); color: white; }
        .hero-btn-primary:hover { background: #b05520; box-shadow: 0 4px 14px rgba(200,98,42,0.35); }
        .hero-btn-secondary { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.1); }
        .hero-btn-secondary:hover { background: rgba(255,255,255,0.14); color: white; }

        /* ── CONTENT ── */
        .content { padding: 28px 36px; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: transform 0.25s, box-shadow 0.25s;
            animation: fadeUp 0.5s ease both;
        }

        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
        }

        .stat-card.blue::before   { background: #3b82f6; }
        .stat-card.orange::before { background: var(--accent); }
        .stat-card.green::before  { background: #22c55e; }
        .stat-card.purple::before { background: #a855f7; }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(13,13,13,0.07);
        }

        .stat-card:nth-child(1) { animation-delay: 0s; }
        .stat-card:nth-child(2) { animation-delay: 0.06s; }
        .stat-card:nth-child(3) { animation-delay: 0.12s; }
        .stat-card:nth-child(4) { animation-delay: 0.18s; }

        .stat-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; }

        .stat-icon {
            width: 38px; height: 38px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-icon svg { width: 18px; height: 18px; }
        .stat-icon.blue   { background: #eff6ff; color: #3b82f6; }
        .stat-icon.orange { background: #fff7ed; color: var(--accent); }
        .stat-icon.green  { background: #f0fdf4; color: #22c55e; }
        .stat-icon.purple { background: #faf5ff; color: #a855f7; }

        .stat-trend {
            font-size: 10px; font-weight: 500;
            padding: 3px 8px; border-radius: 100px;
        }
        .stat-trend.up   { background: #f0fdf4; color: #15803d; }
        .stat-trend.down { background: #fef2f2; color: #dc2626; }
        .stat-trend.flat { background: var(--cream); color: var(--muted); }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 34px; font-weight: 900; letter-spacing: -1px; line-height: 1;
            margin-bottom: 3px;
        }
        .stat-label { font-size: 12px; color: var(--muted); }

        .stat-divider { height: 1px; background: var(--border); margin: 12px 0; }

        .stat-footer {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: var(--muted);
        }
        .stat-footer-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }

        /* ── BOTTOM GRID ── */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 16px;
        }

        /* ── PANEL ── */
        .panel {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.03);
        }

        .panel-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: white;
            display: flex; justify-content: space-between; align-items: center;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 700; letter-spacing: -0.3px;
        }
        .panel-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .panel-body { padding: 22px 24px; }

        /* Chart */
        .chart-wrap { height: 240px; position: relative; }
        .chart-wrap canvas { width: 100% !important; height: 100% !important; }

        .select-period {
            padding: 6px 10px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 8px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; color: var(--muted); outline: none; cursor: pointer;
        }
        .select-period:focus { border-color: var(--accent); }

        /* ── LAPORAN LIST ── */
        .laporan-list { display: flex; flex-direction: column; gap: 8px; }

        .lap-item {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 14px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 12px; text-decoration: none;
            transition: all 0.2s ease;
            position: relative; overflow: hidden;
        }

        .lap-item::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0; width: 3px;
            border-radius: 3px 0 0 3px;
            transform: scaleY(0); transition: transform 0.2s;
        }

        .lap-item:hover { background: white; border-color: rgba(13,13,13,0.15); transform: translateX(3px); }
        .lap-item:hover::before { transform: scaleY(1); }

        .lap-item.blue::before   { background: #3b82f6; }
        .lap-item.green::before  { background: #22c55e; }
        .lap-item.purple::before { background: #a855f7; }
        .lap-item.orange::before { background: var(--accent); }

        .lap-icon {
            width: 38px; height: 38px; min-width: 38px;
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
        }
        .lap-icon svg { width: 18px; height: 18px; }

        .lap-text { flex: 1; min-width: 0; }
        .lap-name { font-size: 12px; font-weight: 500; color: var(--ink); }
        .lap-desc { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .lap-count {
            font-size: 11px; font-weight: 500;
            padding: 3px 9px; border-radius: 100px;
            background: var(--cream); border: 1px solid var(--border);
            color: var(--muted);
        }

        .lap-arrow {
            opacity: 0; transform: translateX(-4px);
            transition: all 0.2s;
            color: var(--muted);
        }
        .lap-arrow svg { width: 14px; height: 14px; }
        .lap-item:hover .lap-arrow { opacity: 1; transform: translateX(0); }

        /* ── QUICK ACTIONS (bawah panel laporan) ── */
        .quick-actions {
            display: grid; grid-template-columns: 1fr 1fr; gap: 8px;
            margin-top: 12px;
        }

        .qa-btn {
            display: flex; align-items: center; gap: 8px;
            padding: 11px 14px;
            background: var(--ink); color: var(--cream);
            border-radius: 10px; text-decoration: none;
            font-size: 12px; font-weight: 500;
            transition: all 0.2s;
        }
        .qa-btn:hover { background: var(--accent); box-shadow: 0 4px 14px rgba(200,98,42,0.25); }
        .qa-btn svg { width: 14px; height: 14px; flex-shrink: 0; }

        .qa-btn-secondary {
            display: flex; align-items: center; gap: 8px;
            padding: 11px 14px;
            background: var(--cream); color: var(--ink);
            border: 1px solid var(--border);
            border-radius: 10px; text-decoration: none;
            font-size: 12px; font-weight: 500;
            transition: all 0.2s;
        }
        .qa-btn-secondary:hover { border-color: var(--accent); color: var(--accent); background: white; }
        .qa-btn-secondary svg { width: 14px; height: 14px; flex-shrink: 0; }

        /* ── CHART LEGEND CUSTOM ── */
        .chart-legend {
            display: flex; gap: 16px; margin-bottom: 14px;
        }
        .legend-item { display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--muted); }
        .legend-dot { width: 8px; height: 8px; border-radius: 50%; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- SIDEBAR (tidak diubah) -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}" class="sidebar-brand-name">Perpustakaan<span>.</span></a>
        <div class="sidebar-brand-sub">Admin Panel</div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-section">Manajemen Buku</div>

        <a href="{{ route('admin.buku.index') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Daftar Buku
        </a>

        <a href="{{ route('admin.buku.create') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Buku
        </a>

        <div class="nav-section">Manajemen User</div>

        <a href="{{ route('admin.users.index') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Kelola User
        </a>

        <div class="nav-section">Lainnya</div>

        <a href="{{ route('admin.transaksi.index') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            Laporan
        </a>
    </nav>

    <div class="sidebar-user">
        <div class="sidebar-user-info">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<main class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <div>
                <div class="topbar-greeting">Panel Administrasi</div>
                <div class="topbar-title">Dashboard</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span id="topbarDate">—</span>
            </div>
            <button class="notif-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span class="notif-dot"></span>
            </button>
        </div>
    </div>

    <!-- HERO BAND -->
    <div class="hero-band">
        <div class="hero-left">
            <div class="hero-welcome">Selamat datang kembali</div>
            <div class="hero-title">{{ Auth::user()->name ?? 'Admin' }}<span>.</span></div>
            <div class="hero-sub">Berikut ringkasan aktivitas perpustakaan hari ini.</div>
        </div>
        <div class="hero-right">
            <a href="{{ route('admin.buku.create') }}" class="hero-btn hero-btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Buku
            </a>
            <a href="{{ route('admin.transaksi.index') }}" class="hero-btn hero-btn-secondary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Lihat Laporan
            </a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- STAT CARDS -->
        <div class="stats-grid">

            <div class="stat-card blue">
                <div class="stat-top">
                    <div class="stat-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <span class="stat-trend up">↑ +12%</span>
                </div>
                <div class="stat-num">{{ $totalBuku }}</div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-divider"></div>
                <div class="stat-footer">
                    <span class="stat-footer-dot" style="background:#3b82f6;"></span>
                    Koleksi aktif di perpustakaan
                </div>
            </div>

            <div class="stat-card orange">
                <div class="stat-top">
                    <div class="stat-icon orange">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    </div>
                    <span class="stat-trend flat">Aktif</span>
                </div>
                <div class="stat-num">{{ $totalDipinjam }}</div>
                <div class="stat-label">Sedang Dipinjam</div>
                <div class="stat-divider"></div>
                <div class="stat-footer">
                    <span class="stat-footer-dot" style="background:var(--accent);"></span>
                    5 jatuh tempo hari ini
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-top">
                    <div class="stat-icon green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <span class="stat-trend up">↑ 98%</span>
                </div>
                <div class="stat-num">{{ $totalTransaksi }}</div>
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-divider"></div>
                <div class="stat-footer">
                    <span class="stat-footer-dot" style="background:#22c55e;"></span>
                    Tepat waktu bulan ini
                </div>
            </div>

            <div class="stat-card purple">
                <div class="stat-top">
                    <div class="stat-icon purple">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span class="stat-trend up">Aman</span>
                </div>
                <div class="stat-num">{{ $totalTersedia }}</div>
                <div class="stat-label">Stok Tersedia</div>
                <div class="stat-divider"></div>
                <div class="stat-footer">
                    <span class="stat-footer-dot" style="background:#a855f7;"></span>
                    Siap dipinjam anggota
                </div>
            </div>

        </div>

        <!-- BOTTOM GRID -->
        <div class="bottom-grid">

            <!-- CHART PANEL -->
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <div class="panel-title">Statistik Peminjaman</div>
                        <div class="panel-sub">Tren peminjaman & pengembalian</div>
                    </div>
                    <select id="chartPeriod" class="select-period">
                        <option value="7">7 Hari</option>
                        <option value="14">14 Hari</option>
                        <option value="30">30 Hari</option>
                    </select>
                </div>
                <div class="panel-body">
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-dot" style="background:#c8622a;"></div>
                            Peminjaman
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background:#22c55e;"></div>
                            Pengembalian
                        </div>
                    </div>
                    <div class="chart-wrap">
                        <canvas id="loanChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- LAPORAN + QUICK ACTIONS -->
            <div>
                <div class="panel" style="margin-bottom:16px;">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">Laporan</div>
                            <div class="panel-sub">Akses cepat laporan sistem</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="laporan-list">

                            <a href="{{ route('admin.transaksi.index') }}" class="lap-item blue">
                                <div class="lap-icon" style="background:#eff6ff; color:#3b82f6;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                </div>
                                <div class="lap-text">
                                    <div class="lap-name">Peminjaman</div>
                                    <div class="lap-desc">Riwayat transaksi</div>
                                </div>
                                <span class="lap-count">{{ $totalTransaksi }}</span>
                                <div class="lap-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
                            </a>

                            <a href="{{ route('admin.buku.index') }}" class="lap-item green">
                                <div class="lap-icon" style="background:#f0fdf4; color:#22c55e;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div class="lap-text">
                                    <div class="lap-name">Koleksi Buku</div>
                                    <div class="lap-desc">Stok & inventaris</div>
                                </div>
                                <span class="lap-count">{{ $totalBuku }}</span>
                                <div class="lap-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
                            </a>

                            <a href="{{ route('admin.users.index') }}" class="lap-item purple">
                                <div class="lap-icon" style="background:#faf5ff; color:#a855f7;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div class="lap-text">
                                    <div class="lap-name">Anggota</div>
                                    <div class="lap-desc">Aktivitas user</div>
                                </div>
                                <span class="lap-count">—</span>
                                <div class="lap-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
                            </a>

                            <a href="#" class="lap-item orange">
                                <div class="lap-icon" style="background:#fff7ed; color:#f97316;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="lap-text">
                                    <div class="lap-name">Keterlambatan</div>
                                    <div class="lap-desc">Belum dikembalikan</div>
                                </div>
                                <span class="lap-count">5</span>
                                <div class="lap-arrow"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></div>
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="{{ route('admin.buku.create') }}" class="qa-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Tambah Buku
                    </a>
                    <a href="{{ route('admin.buku.index') }}" class="qa-btn-secondary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        Daftar Buku
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /* Tanggal */
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const now   = new Date();
    document.getElementById('topbarDate').textContent =
        hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();

    /* Chart helpers */
    function genData(n) { return Array.from({length:n}, () => Math.floor(Math.random()*25)+5); }
    function genLabels(n) {
        const labels = [], today = new Date();
        for (let i = n-1; i >= 0; i--) {
            const d = new Date(today); d.setDate(today.getDate()-i);
            labels.push(d.getDate() + '/' + (d.getMonth()+1));
        }
        return labels;
    }

    /* Chart */
    const ctx = document.getElementById('loanChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: genLabels(7),
            datasets: [
                {
                    label: 'Peminjaman',
                    data: genData(7),
                    backgroundColor: 'rgba(200,98,42,0.15)',
                    borderColor: '#c8622a',
                    borderWidth: 1.5,
                    borderRadius: 5,
                    borderSkipped: false
                },
                {
                    label: 'Pengembalian',
                    data: genData(7),
                    backgroundColor: 'rgba(34,197,94,0.12)',
                    borderColor: '#22c55e',
                    borderWidth: 1.5,
                    borderRadius: 5,
                    borderSkipped: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0d0d0d',
                    titleFont: { family: "'DM Sans',sans-serif", size: 11 },
                    bodyFont:  { family: "'DM Sans',sans-serif", size: 11 },
                    cornerRadius: 8, padding: 10
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: "'DM Sans',sans-serif", size: 10 }, color: '#8a8070' }
                },
                y: {
                    grid: { color: 'rgba(13,13,13,0.05)' },
                    ticks: { font: { family: "'DM Sans',sans-serif", size: 10 }, color: '#8a8070' },
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('chartPeriod').addEventListener('change', function () {
        const n = parseInt(this.value);
        chart.data.labels = genLabels(n);
        chart.data.datasets[0].data = genData(n);
        chart.data.datasets[1].data = genData(n);
        chart.update();
    });

    /* Active sidebar */
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });
</script>

</body>
</html>