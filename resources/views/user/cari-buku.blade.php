<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Buku — Perpustakaan Digital</title>
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
            position: fixed; inset: 0 auto 0 0;
            width: var(--sidebar-w); background: var(--ink);
            display: flex; flex-direction: column; z-index: 100;
        }

        .sidebar-brand { padding: 28px 22px 22px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .sidebar-brand a {
            font-family: 'Playfair Display', serif; font-size: 19px; font-weight: 700;
            color: #fff; text-decoration: none; display: block; letter-spacing: -0.3px;
        }
        .sidebar-brand a span { color: var(--accent-light); }
        .sidebar-brand-sub { font-size: 10px; color: rgba(255,255,255,0.25); letter-spacing: 1.8px; text-transform: uppercase; margin-top: 4px; }

        .sidebar-nav { flex: 1; padding: 14px 12px; overflow-y: auto; }

        .nav-section { font-size: 9.5px; font-weight: 500; letter-spacing: 1.6px; text-transform: uppercase; color: rgba(255,255,255,0.2); padding: 18px 10px 7px; }

        .nav-link {
            display: flex; align-items: center; gap: 10px; padding: 9px 10px;
            border-radius: 9px; font-size: 13px; font-weight: 500;
            color: rgba(255,255,255,0.45); text-decoration: none;
            transition: background 0.15s, color 0.15s; margin-bottom: 2px;
        }
        .nav-link svg { width: 15px; height: 15px; flex-shrink: 0; }
        .nav-link:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85); }
        .nav-link.active { background: var(--accent); color: #fff; }

        .sidebar-footer { padding: 14px 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .sidebar-user-row { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }

        .avatar {
            width: 34px; height: 34px; border-radius: 50%; background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .user-name { font-size: 13px; font-weight: 500; color: #fff; line-height: 1.3; }
        .user-role { font-size: 11px; color: rgba(255,255,255,0.3); }

        .btn-logout {
            width: 100%; padding: 9px; background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            color: rgba(255,255,255,0.4); cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 6px;
            transition: background 0.15s, color 0.15s, border-color 0.15s;
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

        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .topbar-icon { width: 40px; height: 40px; background: var(--ink); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .topbar-icon svg { width: 18px; height: 18px; stroke: white; }
        .topbar-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 900; letter-spacing: -0.6px; line-height: 1.1; }
        .topbar-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: none; border: 1px solid var(--border);
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; color: var(--muted);
            text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        /* ── SEARCH HERO ── */
        .search-hero {
            background: var(--ink);
            padding: 32px 36px;
        }

        .search-hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 26px; font-weight: 900; color: white;
            letter-spacing: -0.8px; margin-bottom: 4px;
        }
        .search-hero-title em { font-style: italic; color: var(--accent-light); }
        .search-hero-sub { font-size: 13px; color: rgba(255,255,255,0.38); margin-bottom: 20px; }

        .search-form {
            display: flex; gap: 10px; align-items: center;
        }

        .search-input-wrap { flex: 1; position: relative; }
        .search-input-wrap svg {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            width: 16px; height: 16px; stroke: var(--muted); pointer-events: none;
        }

        .search-input {
            width: 100%; padding: 12px 14px 12px 42px;
            background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px; font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: white; outline: none;
            transition: all 0.2s;
        }
        .search-input::placeholder { color: rgba(255,255,255,0.3); }
        .search-input:focus { background: rgba(255,255,255,0.11); border-color: var(--accent-light); }

        .btn-search {
            padding: 12px 24px; background: var(--accent); color: white;
            border: none; border-radius: 10px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; cursor: pointer;
            transition: all 0.2s; flex-shrink: 0;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-search svg { width: 14px; height: 14px; }
        .btn-search:hover { background: #b05520; box-shadow: 0 4px 14px rgba(200,98,42,0.4); }

        /* Filter chips */
        .filter-bar {
            background: var(--ink);
            padding: 0 36px 20px;
            display: flex; align-items: center; gap: 8px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .filter-label { font-size: 11px; color: rgba(255,255,255,0.3); margin-right: 4px; text-transform: uppercase; letter-spacing: 0.8px; }

        .filter-chip {
            padding: 5px 14px; border-radius: 100px; font-size: 12px; font-weight: 500;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            border: 1px solid rgba(255,255,255,0.12); color: rgba(255,255,255,0.5);
            background: rgba(255,255,255,0.05);
        }
        .filter-chip:hover { background: rgba(255,255,255,0.1); color: white; }
        .filter-chip.active { background: var(--accent); border-color: var(--accent); color: white; }

        /* ── CONTENT ── */
        .content { padding: 28px 36px; flex: 1; }

        /* Result header */
        .result-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px;
        }

        .result-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px; font-weight: 700; letter-spacing: -0.3px;
        }

        .result-meta { display: flex; align-items: center; gap: 10px; }

        .result-count {
            font-size: 12px; color: var(--muted);
            background: var(--paper); border: 1px solid var(--border);
            padding: 4px 12px; border-radius: 100px;
        }

        .view-toggle { display: flex; gap: 2px; }
        .view-btn {
            width: 32px; height: 32px; border: 1px solid var(--border);
            border-radius: 7px; background: var(--paper); cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.15s;
        }
        .view-btn svg { width: 14px; height: 14px; stroke: var(--muted); }
        .view-btn.active { background: var(--ink); border-color: var(--ink); }
        .view-btn.active svg { stroke: white; }
        .view-btn:hover:not(.active) { border-color: rgba(13,13,13,0.2); }

        /* ── BOOK GRID ── */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .book-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 14px; overflow: hidden;
            transition: transform 0.22s, box-shadow 0.22s;
            cursor: pointer;
            position: relative;
        }
        .book-card:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(13,13,13,0.1); }

        /* Cover area */
        .book-cover-wrap {
            position: relative; width: 100%;
            padding-top: 140%;  /* 5:7 ratio */
            overflow: hidden; background: linear-gradient(135deg, #e8e0d4, #d0c4b4);
        }

        .book-cover-img {
            position: absolute; inset: 0;
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.35s ease;
        }
        .book-card:hover .book-cover-img { transform: scale(1.05); }

        .book-cover-placeholder {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px;
        }

        .book-cover-placeholder-spine {
            width: 60%; height: 70%; border-radius: 4px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 10px; text-align: center;
        }

        .book-cover-placeholder-title {
            font-family: 'Playfair Display', serif;
            font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.9);
            line-height: 1.3;
        }
        .book-cover-placeholder-author { font-size: 9px; color: rgba(255,255,255,0.6); margin-top: 4px; }

        /* Status badge on cover */
        .cover-badge {
            position: absolute; top: 10px; right: 10px;
            font-size: 10px; font-weight: 500; padding: 3px 8px;
            border-radius: 100px; backdrop-filter: blur(4px);
        }
        .cover-badge-available { background: rgba(22,163,74,0.85); color: white; }
        .cover-badge-empty     { background: rgba(220,38,38,0.85); color: white; }

        /* Hover overlay with action */
        .book-overlay {
            position: absolute; inset: 0;
            background: rgba(13,13,13,0.55);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.25s;
        }
        .book-card:hover .book-overlay { opacity: 1; }

        .overlay-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px; background: white; color: var(--ink);
            border-radius: 100px; font-size: 12px; font-weight: 500;
            text-decoration: none; transition: all 0.15s;
            transform: translateY(6px); transition: all 0.25s;
        }
        .book-card:hover .overlay-btn { transform: translateY(0); }
        .overlay-btn:hover { background: var(--accent); color: white; }
        .overlay-btn svg { width: 13px; height: 13px; }

        /* Card body */
        .book-body { padding: 14px; }

        .book-title {
            font-weight: 600; font-size: 13px; line-height: 1.35;
            color: var(--ink); margin-bottom: 4px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

        .book-author { font-size: 11px; color: var(--muted); margin-bottom: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .book-footer {
            display: flex; justify-content: space-between; align-items: center;
            padding-top: 10px; border-top: 1px solid var(--border);
        }

        .book-year { font-size: 11px; color: var(--muted); }

        .book-stok {
            display: flex; align-items: center; gap: 4px;
            font-size: 11px; font-weight: 500;
        }
        .book-stok-dot { width: 6px; height: 6px; border-radius: 50%; }

        /* ── LIST VIEW ── */
        .book-list { display: flex; flex-direction: column; gap: 10px; }

        .list-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 14px; padding: 16px;
            display: flex; gap: 16px; align-items: flex-start;
            transition: all 0.2s;
        }
        .list-card:hover { background: white; border-color: rgba(13,13,13,0.15); box-shadow: 0 4px 16px rgba(13,13,13,0.06); }

        .list-cover {
            width: 64px; height: 88px; border-radius: 8px; flex-shrink: 0;
            overflow: hidden; border: 1px solid var(--border);
            background: linear-gradient(135deg, #e8e0d4, #d0c4b4);
            position: relative;
        }
        .list-cover img { width: 100%; height: 100%; object-fit: cover; }
        .list-cover-placeholder {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .list-cover-placeholder svg { width: 24px; height: 24px; stroke: var(--muted); opacity: 0.5; }

        .list-info { flex: 1; min-width: 0; }
        .list-title { font-size: 14px; font-weight: 600; color: var(--ink); margin-bottom: 3px; line-height: 1.3; }
        .list-author { font-size: 12px; color: var(--muted); margin-bottom: 10px; }

        .list-meta { display: flex; gap: 14px; flex-wrap: wrap; }
        .list-meta-item { display: flex; align-items: center; gap: 5px; font-size: 11px; color: var(--muted); }
        .list-meta-item svg { width: 12px; height: 12px; }

        .list-right { display: flex; flex-direction: column; align-items: flex-end; gap: 8px; flex-shrink: 0; }

        .list-badge {
            font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 100px;
            display: flex; align-items: center; gap: 4px;
        }
        .list-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: 0.6; }
        .badge-green { background: #f0fdf4; color: #15803d; }
        .badge-red   { background: #fef2f2; color: #dc2626; }
        .badge-yellow { background: #fefce8; color: #a16207; }

        .btn-pinjam {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 7px 14px; background: var(--ink); color: white;
            border-radius: 100px; font-size: 11px; font-weight: 500;
            text-decoration: none; transition: all 0.2s; border: none; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-pinjam:hover { background: var(--accent); box-shadow: 0 4px 12px rgba(200,98,42,0.3); }
        .btn-pinjam svg { width: 12px; height: 12px; }
        .btn-pinjam:disabled { background: var(--muted); cursor: not-allowed; opacity: 0.6; }

        /* ── SEARCH RESULT QUERY BANNER ── */
        .query-banner {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; background: #fff7ed;
            border: 1px solid #fed7aa; border-radius: 10px;
            margin-bottom: 20px; font-size: 13px; color: #92400e;
        }
        .query-banner svg { width: 16px; height: 16px; flex-shrink: 0; }
        .query-banner a { color: var(--accent); font-weight: 500; text-decoration: none; margin-left: auto; font-size: 12px; }

        /* ── EMPTY STATE ── */
        .empty-state {
            text-align: center; padding: 70px 20px; color: var(--muted);
        }
        .empty-icon {
            width: 72px; height: 72px; border-radius: 50%;
            background: var(--paper); border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .empty-icon svg { width: 32px; height: 32px; stroke: var(--muted); }
        .empty-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px; font-weight: 700; color: var(--ink); margin-bottom: 6px;
        }
        .empty-sub { font-size: 13px; margin-bottom: 20px; }

        .btn-reset {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 20px; background: var(--ink); color: white;
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.2s;
        }
        .btn-reset:hover { background: var(--accent); }

        /* ── PAGINATION ── */
        .pagination-wrap { margin-top: 32px; }

        /* Book cover color palettes for placeholder */
        .bc-1 { background: linear-gradient(135deg, #3b4a6b, #2a3555); }
        .bc-2 { background: linear-gradient(135deg, #c8622a, #a04d1f); }
        .bc-3 { background: linear-gradient(135deg, #5a6e4a, #3d4f31); }
        .bc-4 { background: linear-gradient(135deg, #8a6a3a, #6b4f28); }
        .bc-5 { background: linear-gradient(135deg, #4a5a7a, #364470); }
        .bc-6 { background: linear-gradient(135deg, #7a4a6a, #5e3450); }
        .bc-7 { background: linear-gradient(135deg, #4a7a6a, #346050); }
        .bc-8 { background: linear-gradient(135deg, #6a4a3a, #4e342a); }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .book-card, .list-card { animation: fadeUp 0.35s ease both; }
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
        <a href="{{ route('user.dashboard') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>
        <a href="{{ route('user.buku.cari') }}" class="nav-link active">
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
            <div class="topbar-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div>
                <div class="topbar-title">Cari Buku</div>
                <div class="topbar-sub">Temukan buku favoritmu</div>
            </div>
        </div>
        <a href="{{ route('user.dashboard') }}" class="btn-back">← Dashboard</a>
    </div>

    <!-- SEARCH HERO -->
    <div class="search-hero">
        <div class="search-hero-title">Mau baca <em>apa</em> hari ini?</div>
        <div class="search-hero-sub">Cari dari ribuan koleksi berdasarkan judul, pengarang, atau penerbit.</div>
        <form method="GET" action="{{ route('user.buku.cari') }}" class="search-form" id="searchForm">
            <div class="search-input-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="q" id="searchInput"
                    class="search-input"
                    value="{{ $query ?? '' }}"
                    placeholder="Cari judul, pengarang, penerbit…"
                    autocomplete="off" autofocus>
            </div>
            <button type="submit" class="btn-search">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari
            </button>
        </form>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar">
        <span class="filter-label">Filter</span>
        <a href="{{ route('user.buku.cari', ['q' => $query ?? '']) }}" class="filter-chip active">Semua</a>
        <a href="{{ route('user.buku.cari', ['q' => $query ?? '', 'filter' => 'tersedia']) }}" class="filter-chip {{ request('filter') === 'tersedia' ? 'active' : '' }}">Tersedia</a>
        <a href="{{ route('user.buku.cari', ['q' => $query ?? '', 'filter' => 'terbaru']) }}" class="filter-chip {{ request('filter') === 'terbaru' ? 'active' : '' }}">Terbaru</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        {{-- Query banner --}}
        @if($query ?? false)
        <div class="query-banner">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Hasil pencarian untuk <strong style="margin:0 4px;">"{{ $query }}"</strong>
            <a href="{{ route('user.buku.cari') }}">Hapus pencarian ✕</a>
        </div>
        @endif

        @if($buku->count())

        <!-- Result header -->
        <div class="result-header">
            <div>
                <div class="result-title">{{ $query ? 'Hasil Pencarian' : 'Semua Koleksi' }}</div>
            </div>
            <div class="result-meta">
                <span class="result-count">{{ $buku->total() }} buku</span>
                <div class="view-toggle">
                    <button class="view-btn active" id="btnGrid" title="Tampilan Grid">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    </button>
                    <button class="view-btn" id="btnList" title="Tampilan List">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- GRID VIEW --}}
        <div class="book-grid" id="viewGrid">
            @foreach($buku as $i => $item)
            @php
                $colors = ['bc-1','bc-2','bc-3','bc-4','bc-5','bc-6','bc-7','bc-8'];
                $color  = $colors[$i % count($colors)];
                $stokOk = $item->stok > 0;
            @endphp
            <div class="book-card" style="animation-delay: {{ $loop->index * 0.04 }}s">
                <div class="book-cover-wrap">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->judul }}"
                             class="book-cover-img">
                    @else
                        <div class="book-cover-placeholder">
                            <div class="book-cover-placeholder-spine {{ $color }}">
                                <div class="book-cover-placeholder-title">{{ Str::limit($item->judul, 30) }}</div>
                                <div class="book-cover-placeholder-author">{{ Str::limit($item->pengarang, 20) }}</div>
                            </div>
                        </div>
                    @endif

                    <span class="cover-badge {{ $stokOk ? 'cover-badge-available' : 'cover-badge-empty' }}">
                        {{ $stokOk ? 'Tersedia' : 'Habis' }}
                    </span>

                    <div class="book-overlay">
                        <a href="{{ route('transaksi.create') }}" class="overlay-btn">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            Pinjam
                        </a>
                    </div>
                </div>

                <div class="book-body">
                    <div class="book-title">{{ $item->judul }}</div>
                    <div class="book-author">{{ $item->pengarang }}</div>
                    <div class="book-footer">
                        <span class="book-year">{{ $item->tahun_terbit }}</span>
                        <div class="book-stok">
                            <div class="book-stok-dot" style="background: {{ $stokOk ? '#16a34a' : '#dc2626' }};"></div>
                            <span style="color: {{ $stokOk ? '#16a34a' : '#dc2626' }}; font-size:11px;">{{ $item->stok }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- LIST VIEW --}}
        <div class="book-list" id="viewList" style="display:none;">
            @foreach($buku as $i => $item)
            @php
                $colors = ['bc-1','bc-2','bc-3','bc-4','bc-5','bc-6','bc-7','bc-8'];
                $color  = $colors[$i % count($colors)];
                $stokOk = $item->stok > 0;
            @endphp
            <div class="list-card" style="animation-delay: {{ $loop->index * 0.03 }}s">
                <div class="list-cover">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                    @else
                        <div class="list-cover-placeholder {{ $color }}" style="position:absolute;inset:0;">
                            <svg fill="none" stroke="rgba(255,255,255,0.5)" viewBox="0 0 24 24" style="width:22px;height:22px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    @endif
                </div>

                <div class="list-info">
                    <div class="list-title">{{ $item->judul }}</div>
                    <div class="list-author">{{ $item->pengarang }}</div>
                    <div class="list-meta">
                        <div class="list-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                            {{ $item->penerbit }}
                        </div>
                        <div class="list-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $item->tahun_terbit }}
                        </div>
                        <div class="list-meta-item">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            Stok: {{ $item->stok }}
                        </div>
                    </div>
                </div>

                <div class="list-right">
                    @if($item->stok > 5)
                        <span class="list-badge badge-green">Tersedia</span>
                    @elseif($item->stok > 0)
                        <span class="list-badge badge-yellow">Hampir Habis</span>
                    @else
                        <span class="list-badge badge-red">Habis</span>
                    @endif
                    <a href="{{ route('transaksi.create') }}"
                       class="btn-pinjam"
                       @if(!$stokOk) style="pointer-events:none; opacity:0.5;" @endif>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        Pinjam
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $buku->appends(['q' => $query])->links() }}
        </div>

        @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="empty-title">Buku tidak ditemukan</div>
            <div class="empty-sub">Coba gunakan kata kunci lain atau periksa ejaan</div>
            <a href="{{ route('user.buku.cari') }}" class="btn-reset">Lihat semua koleksi</a>
        </div>
        @endif

    </div>
</main>

<script>
    /* Active sidebar */
    const path = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === path) {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });

    /* Grid / List toggle */
    const btnGrid  = document.getElementById('btnGrid');
    const btnList  = document.getElementById('btnList');
    const viewGrid = document.getElementById('viewGrid');
    const viewList = document.getElementById('viewList');

    if (btnGrid && btnList) {
        btnGrid.addEventListener('click', () => {
            viewGrid.style.display = 'grid';
            viewList.style.display = 'none';
            btnGrid.classList.add('active');
            btnList.classList.remove('active');
            localStorage.setItem('bookView', 'grid');
        });

        btnList.addEventListener('click', () => {
            viewGrid.style.display = 'none';
            viewList.style.display = 'flex';
            btnList.classList.add('active');
            btnGrid.classList.remove('active');
            localStorage.setItem('bookView', 'list');
        });

        /* Restore preference */
        if (localStorage.getItem('bookView') === 'list') {
            btnList.click();
        }
    }
</script>

</body>
</html>