<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:          #0d0d0d;
            --paper:        #f5f0e8;
            --cream:        #faf7f2;
            --accent:       #c8622a;
            --accent-light: #e8956a;
            --muted:        #8a8070;
            --border:       rgba(13,13,13,0.09);
            --sidebar-w:    248px;
            --radius:       14px;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0ebe0;
            color: var(--ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-w);
            background: var(--ink);
            display: flex; flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand { padding: 28px 22px 22px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .sidebar-brand a {
            font-family: 'Playfair Display', serif;
            font-size: 19px; font-weight: 700;
            color: #fff; text-decoration: none; display: block; letter-spacing: -0.3px;
        }
        .sidebar-brand a span { color: var(--accent-light); }
        .sidebar-brand-sub {
            font-size: 10px; color: rgba(255,255,255,0.25);
            letter-spacing: 1.8px; text-transform: uppercase; margin-top: 4px;
        }

        .sidebar-nav { flex: 1; padding: 14px 12px; overflow-y: auto; }

        .nav-section {
            font-size: 9.5px; font-weight: 500; letter-spacing: 1.6px;
            text-transform: uppercase; color: rgba(255,255,255,0.2); padding: 18px 10px 7px;
        }

        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; border-radius: 9px;
            font-size: 13px; font-weight: 500; color: rgba(255,255,255,0.45);
            text-decoration: none; transition: background 0.15s, color 0.15s; margin-bottom: 2px;
        }
        .nav-link svg    { width: 15px; height: 15px; flex-shrink: 0; }
        .nav-link:hover  { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-link.active { background: var(--accent); color: #fff; }

        .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .sidebar-user-row { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }

        .avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--accent); display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
        }

        .user-name { font-size: 13px; font-weight: 500; color: #fff; line-height: 1.3; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.3); }

        .btn-logout {
            width: 100%; padding: 9px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; color: rgba(255,255,255,0.4);
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            gap: 6px; transition: background 0.15s, color 0.15s, border-color 0.15s;
        }
        .btn-logout svg { width: 13px; height: 13px; }
        .btn-logout:hover { background: rgba(200,98,42,0.18); color: var(--accent-light); border-color: rgba(200,98,42,0.3); }

        /* ── MAIN ── */
        .main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        /* ── TOPBAR ── */
        .topbar {
            position: sticky; top: 0; z-index: 50;
            background: var(--paper); border-bottom: 1px solid var(--border);
            padding: 0 36px; height: 72px;
            display: flex; justify-content: space-between; align-items: center;
        }

        .topbar-left { display: flex; align-items: center; gap: 12px; }

        .topbar-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--ink); display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 700; color: white;
        }

        .topbar-greeting { font-size: 11px; color: var(--muted); }
        .topbar-name { font-size: 14px; font-weight: 500; color: var(--ink); }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-date-pill {
            display: flex; align-items: center; gap: 7px;
            padding: 7px 14px; background: var(--cream);
            border: 1px solid var(--border); border-radius: 100px;
            font-size: 12px; color: var(--muted);
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
            width: 6px; height: 6px; background: var(--accent);
            border-radius: 50%; border: 1.5px solid var(--paper);
        }

        /* ── CONTENT ── */
        .content { padding: 0; flex: 1; }

        /* ── HERO ── */
        .hero {
            background: var(--ink);
            padding: 36px 36px 0;
            position: relative; overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute; right: 180px; top: -60px;
            width: 280px; height: 280px; border-radius: 50%;
            background: rgba(200,98,42,0.06); pointer-events: none;
        }

        .hero-inner {
            display: flex; justify-content: space-between; align-items: flex-end;
            gap: 20px; position: relative; z-index: 1;
        }

        .hero-left { padding-bottom: 36px; }

        .hero-eyebrow {
            display: flex; align-items: center; gap: 8px;
            font-size: 10.5px; font-weight: 500; letter-spacing: 1.8px;
            text-transform: uppercase; color: var(--accent-light); margin-bottom: 14px;
        }
        .hero-eyebrow::before {
            content: ''; display: block;
            width: 20px; height: 1px; background: var(--accent-light);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 36px; font-weight: 900; letter-spacing: -1.2px;
            color: white; line-height: 1.15; margin-bottom: 10px;
        }
        .hero-title em { font-style: italic; color: var(--accent-light); }

        .hero-sub { font-size: 13px; color: rgba(255,255,255,0.4); margin-bottom: 28px; }

        .hero-actions { display: flex; gap: 10px; flex-wrap: wrap; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; background: var(--accent); color: #fff;
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-primary:hover { background: #b05520; box-shadow: 0 6px 20px rgba(200,98,42,0.35); }
        .btn-primary svg { width: 14px; height: 14px; }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 20px; background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.65); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.2s;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.13); color: white; }
        .btn-ghost svg { width: 14px; height: 14px; }

        /* Hero illustration / book stack */
        .hero-right {
            align-self: flex-end;
            display: flex; align-items: flex-end; gap: 6px;
            padding-bottom: 0;
        }

        .hero-book {
            border-radius: 6px 6px 0 0;
            width: 38px;
        }

        /* Stats band at bottom of hero */
        .hero-stats {
            display: flex; gap: 1px;
            background: rgba(255,255,255,0.06);
            border-top: 1px solid rgba(255,255,255,0.07);
            margin: 0 -36px;
        }

        .hero-stat {
            flex: 1; padding: 16px 24px;
            display: flex; align-items: center; gap: 14px;
            transition: background 0.15s;
        }
        .hero-stat:hover { background: rgba(255,255,255,0.03); }

        .hero-stat-icon {
            width: 36px; height: 36px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .hero-stat-icon svg { width: 16px; height: 16px; }

        .hero-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 900; color: white; line-height: 1;
        }
        .hero-stat-label { font-size: 11px; color: rgba(255,255,255,0.38); margin-top: 2px; }

        .hero-stat-divider { width: 1px; background: rgba(255,255,255,0.07); flex-shrink: 0; }

        /* ── MAIN BODY ── */
        .body-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            padding: 24px 36px;
        }

        /* ── PANEL ── */
        .panel {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 16px rgba(13,13,13,0.04);
        }

        .panel-header {
            padding: 16px 20px; border-bottom: 1px solid var(--border);
            background: white; display: flex; justify-content: space-between; align-items: center;
        }

    .panel-title {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: -0.3px;
    color: #000;
}

.panel-sub {
    font-size: 11px;
    color: #000; /* dari var(--muted) jadi hitam */
    margin-top: 1px;
}

.panel-body {
    padding: 20px;
    color: #000;
}
        /* ── BOOK CARDS ── */
        .book-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .book-card {
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 12px; padding: 14px;
            display: flex; gap: 12px; align-items: flex-start;
            text-decoration: none; color: inherit;
            transition: all 0.2s;
        }
        .book-card:hover { background: white; border-color: rgba(13,13,13,0.16); transform: translateY(-2px); box-shadow: 0 6px 18px rgba(13,13,13,0.07); }

        .book-thumb {
            width: 44px; height: 60px; border-radius: 6px;
            background: linear-gradient(135deg, #e8e0d4, #d4c8b8);
            border: 1px solid var(--border); display: flex; align-items: center;
            justify-content: center; flex-shrink: 0; overflow: hidden;
        }
        .book-thumb svg { width: 18px; height: 18px; stroke: var(--muted); opacity: 0.5; }
        .book-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .book-info {}
        .book-title { font-size: 12px; font-weight: 500; color: var(--ink); line-height: 1.3; margin-bottom: 3px; }
        .book-author { font-size: 11px; color: var(--muted); margin-bottom: 6px; }

        .book-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 2px 8px; border-radius: 100px;
            font-size: 10px; font-weight: 500;
        }
        .book-badge::before { content: ''; width: 4px; height: 4px; border-radius: 50%; background: currentColor; opacity: 0.6; }
        .book-badge-green  { background: #f0fdf4; color: #15803d; }
        .book-badge-red    { background: #fef2f2; color: #dc2626; }

        /* ── ACTIVITY / RIWAYAT ── */
        .activity-list { display: flex; flex-direction: column; gap: 10px; }

        .activity-item {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 14px; background: var(--cream);
            border: 1px solid var(--border); border-radius: 11px;
            text-decoration: none; color: inherit; transition: all 0.2s;
        }
        .activity-item:hover { background: white; border-color: rgba(13,13,13,0.15); }

        .activity-icon {
            width: 36px; height: 36px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .activity-icon svg { width: 16px; height: 16px; }

        .activity-text { flex: 1; min-width: 0; }
        .activity-title { font-size: 12px; font-weight: 500; color: var(--ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .activity-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .activity-status {
            font-size: 10px; font-weight: 500;
            padding: 3px 9px; border-radius: 100px; flex-shrink: 0;
        }
        .status-active  { background: #fff7ed; color: #c2410c; }
        .status-done    { background: #f0fdf4; color: #15803d; }
        .status-late    { background: #fef2f2; color: #dc2626; }

        /* ── QUICK LINKS ── */
        .quick-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }

        .quick-card {
            display: flex; flex-direction: column; align-items: center;
            text-align: center; gap: 8px; padding: 18px 10px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 12px; text-decoration: none; color: var(--ink);
            transition: all 0.2s;
        }
        .quick-card:hover { background: white; border-color: var(--accent); transform: translateY(-2px); }
        .quick-card:hover .quick-icon { background: var(--accent); color: white; }

        .quick-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .quick-icon svg { width: 18px; height: 18px; }
        .quick-label { font-size: 12px; font-weight: 500; }

        /* ── INFO CARD ── */
        .info-card {
            background: var(--ink); border-radius: 14px; padding: 20px;
            margin-top: 14px;
        }

        .info-card-title {
            font-size: 11px; font-weight: 500; color: rgba(255,255,255,0.35);
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px;
        }

        .info-rule { display: flex; flex-direction: column; gap: 10px; }

        .info-rule-item { display: flex; align-items: flex-start; gap: 9px; }
        .info-rule-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--accent-light); margin-top: 4px; flex-shrink: 0; }
        .info-rule-text { font-size: 12px; color: rgba(255,255,255,0.5); line-height: 1.5; }
        .info-rule-text strong { color: rgba(255,255,255,0.8); font-weight: 500; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center; padding: 32px 20px; color: var(--muted);
        }
        .empty-icon {
            width: 48px; height: 48px; border-radius: 50%;
            background: var(--cream); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px;
        }
        .empty-icon svg { width: 22px; height: 22px; stroke: var(--muted); }
        .empty-state p { font-size: 13px; margin-bottom: 12px; }

        .btn-sm {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 16px; background: var(--ink); color: white;
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; text-decoration: none; transition: all 0.2s;
        }
        .btn-sm:hover { background: var(--accent); }
        .btn-sm svg { width: 12px; height: 12px; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .hero-stat:nth-child(1) { animation: fadeUp 0.4s ease both 0.05s; }
        .hero-stat:nth-child(2) { animation: fadeUp 0.4s ease both 0.1s; }
        .hero-stat:nth-child(3) { animation: fadeUp 0.4s ease both 0.15s; }
        .panel { animation: fadeUp 0.5s ease both 0.2s; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('home') }}">Perpustakaan<span>.</span></a>
        <div class="sidebar-brand-sub">Digital Library</div>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('user.dashboard') }}" class="nav-link active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
       <a href="{{ route('user.cari') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Buku
        </a>

        <div class="nav-section">Peminjaman</div>

        <a href="{{ route('transaksi.index') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            Riwayat Peminjaman
        </a>
        <a href="{{ route('transaksi.create') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            Pinjam Buku
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user-row">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                <div class="user-role">Member</div>
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
            <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}</div>
            <div>
                <div class="topbar-greeting">Selamat datang kembali</div>
                <div class="topbar-name">{{ Auth::user()->name ?? 'User' }}</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span id="topbarDate">—</span>
            </div>
            <button class="notif-btn" aria-label="Notifikasi">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span class="notif-dot"></span>
            </button>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- HERO -->
        <div class="hero">
            <div class="hero-inner">
                <div class="hero-left">
                    <div class="hero-eyebrow">Perpustakaan Digital</div>
                    <div class="hero-title">
                        Temukan buku<br><em>favoritmu</em><br>hari ini
                    </div>
                    <div class="hero-sub">Jelajahi ribuan koleksi dan pinjam dengan mudah.</div>
                    <div class="hero-actions">
                     <a href="{{ route('user.cari') }}" class="btn-primary">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Jelajahi Koleksi
                        </a>
                        <a href="{{ route('transaksi.create') }}" class="btn-ghost">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            Pinjam Sekarang
                        </a>
                    </div>
                </div>

                <!-- Dekorasi tumpukan buku -->
                <div class="hero-right">
                    <div class="hero-book" style="height:100px; background:#3b4a6b; opacity:0.7;"></div>
                    <div class="hero-book" style="height:130px; background:#c8622a; opacity:0.85;"></div>
                    <div class="hero-book" style="height:80px;  background:#5a6e4a; opacity:0.7;"></div>
                    <div class="hero-book" style="height:115px; background:#8a6a3a; opacity:0.75;"></div>
                    <div class="hero-book" style="height:95px;  background:#4a5a7a; opacity:0.65;"></div>
                </div>
            </div>

            <!-- Stats band -->
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="background:rgba(59,130,246,0.15); color:#93c5fd;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div>
                        <div class="hero-stat-num">{{ $transaksiSaya }}</div>
                        <div class="hero-stat-label">Total Peminjaman</div>
                    </div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="background:rgba(200,98,42,0.15); color:var(--accent-light);">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="hero-stat-num">0</div>
                        <div class="hero-stat-label">Sedang Dipinjam</div>
                    </div>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <div class="hero-stat-icon" style="background:rgba(34,197,94,0.12); color:#86efac;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="hero-stat-num">{{ $transaksiSaya }}</div>
                        <div class="hero-stat-label">Buku Selesai Dibaca</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BODY GRID -->
        <div class="body-grid">

            <!-- KOLOM KIRI -->
            <div style="display:flex; flex-direction:column; gap:16px;">

                <!-- Koleksi Terbaru -->
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">Koleksi Buku</div>
                            <div class="panel-sub">Buku tersedia untuk dipinjam</div>
                        </div>
                        <a href="{{ route('user.cari') }}" style="font-size:12px; color:var(--accent); text-decoration:none; font-weight:500;">Lihat semua →</a>
                    </div>
                    <div class="panel-body">
                        @if(isset($bukuTersedia) && $bukuTersedia->count() > 0)
                        <div class="book-grid">
                            @foreach($bukuTersedia->take(4) as $buku)
                            <a href="{{ route('user.cari') }}" class="book-card">
                                <div class="book-thumb">
                                    @if($buku->image)
                                        <img src="{{ asset('storage/' . $buku->image) }}" alt="{{ $buku->judul }}">
                                    @else
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    @endif
                                </div>
                                <div class="book-info">
                                    <div class="book-title">{{ Str::limit($buku->judul, 36) }}</div>
                                    <div class="book-author">{{ $buku->pengarang }}</div>
                                    @if($buku->stok > 0)
                                        <span class="book-badge book-badge-green">Tersedia</span>
                                    @else
                                        <span class="book-badge book-badge-red">Habis</span>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <p>Belum ada koleksi buku.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Peminjaman -->
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">Riwayat Peminjaman</div>
                            <div class="panel-sub">Aktivitas peminjaman terbaru</div>
                        </div>
                        <a href="{{ route('transaksi.index') }}" style="font-size:12px; color:var(--accent); text-decoration:none; font-weight:500;">Lihat semua →</a>
                    </div>
                    <div class="panel-body">
                        @if(isset($riwayat) && $riwayat->count() > 0)
                        <div class="activity-list">
                            @foreach($riwayat->take(4) as $trx)
                            <a href="{{ route('transaksi.index') }}" class="activity-item">
                                <div class="activity-icon" style="background:#eff6ff; color:#3b82f6;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </div>
                                <div class="activity-text">
                                    <div class="activity-title">{{ $trx->buku->judul ?? '—' }}</div>
                                    <div class="activity-sub">{{ $trx->tanggal_pinjam ? \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') : '—' }}</div>
                                </div>
                                @if($trx->status === 'dipinjam')
                                    <span class="activity-status status-active">Dipinjam</span>
                                @elseif($trx->status === 'dikembalikan')
                                    <span class="activity-status status-done">Selesai</span>
                                @else
                                    <span class="activity-status status-late">Terlambat</span>
                                @endif
                            </a>
                            @endforeach
                        </div>
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            <p>Belum ada riwayat peminjaman.</p>
                            <a href="{{ route('transaksi.create') }}" class="btn-sm">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                Pinjam Buku
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN -->
            <div style="display:flex; flex-direction:column; gap:16px;">

                <!-- Aksi Cepat -->
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">Aksi Cepat</div>
                            <div class="panel-sub">Navigasi singkat</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="quick-grid">
                            <a href="{{ route('user.cari')}}" class="quick-card">
                                <div class="quick-icon" style="background:#eff6ff; color:#3b82f6;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                                <span class="quick-label">Cari Buku</span>
                            </a>
                            <a href="{{ route('transaksi.create') }}" class="quick-card">
                                <div class="quick-icon" style="background:#fff7ed; color:#f97316;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                                </div>
                                <span class="quick-label">Pinjam Buku</span>
                            </a>
                            <a href="{{ route('transaksi.index') }}" class="quick-card">
                                <div class="quick-icon" style="background:#f0fdf4; color:#22c55e;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <span class="quick-label">Riwayat</span>
                            </a>
                            <a href="{{ route('home') }}" class="quick-card">
                                <div class="quick-icon" style="background:#faf5ff; color:#a855f7;">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </div>
                                <span class="quick-label">Beranda</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info & Aturan -->
                <div class="panel">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">Aturan Peminjaman</div>
                            <div class="panel-sub">Perlu kamu ketahui</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="info-rule">
                            <div class="info-rule-item">
                                <div class="info-rule-dot" style="background:#3b82f6;"></div>
                                <div class="info-rule-text">Maksimal <strong>3 buku</strong> dipinjam secara bersamaan.</div>
                            </div>
                            <div class="info-rule-item">
                                <div class="info-rule-dot" style="background:#22c55e;"></div>
                                <div class="info-rule-text">Durasi peminjaman <strong>7 hari</strong> per buku.</div>
                            </div>
                            <div class="info-rule-item">
                                <div class="info-rule-dot" style="background:var(--accent);"></div>
                                <div class="info-rule-text">Pengembalian terlambat dikenakan <strong>denda harian</strong>.</div>
                            </div>
                            <div class="info-rule-item">
                                <div class="info-rule-dot" style="background:#a855f7;"></div>
                                <div class="info-rule-text">Buku yang rusak menjadi <strong>tanggung jawab peminjam</strong>.</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>

<script>
    /* Tanggal */
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const now   = new Date();
    document.getElementById('topbarDate').textContent =
        hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();

    /* Active sidebar */
    const path = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === path) {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });
</script>

</body>
</html>