<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku — Perpustakaan Digital</title>
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
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .sidebar-brand {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar-brand-name span { color: var(--accent-light); }

        .sidebar-brand-sub {
            font-size: 11px;
            color: rgba(255,255,255,0.3);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.25);
            padding: 16px 12px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 2px;
        }

        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-link:hover { background: rgba(255,255,255,0.07); color: white; }
        .sidebar-link.active { background: var(--accent); color: white; }

        .sidebar-user {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 34px; height: 34px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 13px; font-weight: 500; color: white; line-height: 1.2; }
        .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.35); }

        .btn-logout {
            width: 100%;
            padding: 9px;
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-icon {
            width: 40px; height: 40px;
            background: var(--ink);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .topbar-icon svg { width: 18px; height: 18px; stroke: white; }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -0.6px;
            line-height: 1.1;
        }

        .topbar-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .topbar-actions { display: flex; gap: 10px; align-items: center; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        .btn-add {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 20px;
            background: var(--ink);
            color: var(--cream);
            border: none;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-add:hover { background: var(--accent); box-shadow: 0 6px 20px rgba(200,98,42,0.28); }

        /* ── STATS BAR ── */
        .stats-bar {
            display: flex;
            gap: 1px;
            background: var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stat-item {
            flex: 1;
            background: var(--paper);
            padding: 14px 24px;
            display: flex; align-items: center; gap: 12px;
            transition: background 0.2s;
        }

        .stat-item:hover { background: white; }

        .stat-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .stat-label {
            font-size: 11px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 500;
        }

        .stat-val {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        /* ── CONTENT ── */
        .content { padding: 28px 36px; }

        /* ── ALERT ── */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            background: white;
            border: 1px solid #c3e6c3;
            border-left: 3px solid #22c55e;
            color: #166534;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .alert-success svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── TOOLBAR ── */
        .toolbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 16px;
            gap: 12px;
        }

        .search-wrap {
            position: relative;
            flex: 1; max-width: 320px;
        }

        .search-wrap svg {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            width: 14px; height: 14px; stroke: var(--muted);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 9px 14px 9px 36px;
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            outline: none;
            transition: all 0.2s;
        }
        .search-input::placeholder { color: var(--muted); }
        .search-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(200,98,42,0.08); }

        .toolbar-right { display: flex; gap: 8px; align-items: center; }

        .filter-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 14px;
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; color: var(--muted);
            cursor: pointer; transition: all 0.2s;
        }
        .filter-btn:hover { color: var(--ink); border-color: rgba(13,13,13,0.2); background: white; }
        .filter-btn svg { width: 13px; height: 13px; }

        /* ── TABLE ── */
        .table-wrap {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
        }

        .table-header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: white;
        }

        .table-header-title { font-size: 13px; font-weight: 500; color: var(--ink); }

        .table-count {
            font-size: 11px; color: var(--muted);
            background: var(--cream);
            padding: 3px 10px;
            border-radius: 100px;
            border: 1px solid var(--border);
        }

        .table-scroll { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 13px; }

        thead tr { background: var(--cream); border-bottom: 1px solid var(--border); }

        thead th {
            padding: 11px 16px;
            text-align: left;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        thead th.center { text-align: center; }
        thead th:first-child { padding-left: 20px; }
        thead th:last-child { padding-right: 20px; }

        tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.6); }

        td { padding: 13px 16px; color: var(--ink); vertical-align: middle; }
        td.center { text-align: center; }
        td:first-child { padding-left: 20px; }
        td:last-child { padding-right: 20px; }

        /* Nomor urut bulat */
        .td-num {
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
            background: var(--cream);
            width: 28px; height: 28px;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            border: 1px solid var(--border);
        }

        /* Cover book */
        .book-cover-placeholder {
            width: 40px; height: 54px;
            border-radius: 6px;
            background: linear-gradient(135deg, #e8e0d4 0%, #d4c8b8 100%);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            border: 1px solid var(--border);
        }
        .book-cover-placeholder svg { width: 16px; height: 16px; stroke: var(--muted); opacity: 0.6; }

        .book-cover-img {
            width: 40px; height: 54px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid var(--border);
            display: block;
        }

        /* Judul + pengarang */
        .td-book { display: flex; align-items: center; gap: 12px; }
        .td-book-title { font-weight: 500; font-size: 13px; color: var(--ink); line-height: 1.3; }
        .td-book-author { font-size: 11px; color: var(--muted); margin-top: 2px; }

        /* Badges stok */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px;
            border-radius: 100px;
            font-size: 11px; font-weight: 500;
        }
        .badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.6;
            flex-shrink: 0;
        }
        .badge-green  { background: #f0fdf4; color: #15803d; }
        .badge-yellow { background: #fefce8; color: #a16207; }
        .badge-red    { background: #fef2f2; color: #dc2626; }

        /* Tombol aksi */
        .actions-cell { display: flex; gap: 5px; justify-content: center; }

        .btn-edit, .btn-delete {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 5px 12px;
            border-radius: 6px;
            font-family: 'DM Sans', sans-serif;
            font-size: 11px; font-weight: 500;
            cursor: pointer; border: none;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-edit { background: #eff6ff; color: #2563eb; }
        .btn-edit:hover { background: #2563eb; color: white; }
        .btn-delete { background: #fef2f2; color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: white; }
        .btn-edit svg, .btn-delete svg { width: 11px; height: 11px; }

        /* Footer tabel */
        .table-footer {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px 20px;
            border-top: 1px solid var(--border);
            background: var(--cream);
        }

        .page-info { font-size: 12px; color: var(--muted); }

        .pagination { display: flex; gap: 4px; }

        .page-btn {
            width: 28px; height: 28px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 6px;
            font-size: 12px; font-weight: 500; color: var(--muted);
            background: none; border: 1px solid var(--border);
            cursor: pointer; transition: all 0.15s; text-decoration: none;
        }
        .page-btn:hover { background: white; color: var(--ink); border-color: rgba(13,13,13,0.15); }
        .page-btn.active { background: var(--ink); color: white; border-color: var(--ink); }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
            font-size: 14px;
        }

        .empty-state-icon {
            width: 48px; height: 48px;
            background: var(--cream);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
            border: 1px solid var(--border);
        }
        .empty-state-icon svg { width: 22px; height: 22px; stroke: var(--muted); }
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
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-section">Manajemen Buku</div>

        <a href="{{ route('admin.buku.index') }}" class="sidebar-link active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            Daftar Buku
        </a>
  <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
    </svg>
    Kategori Buku
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
            <div class="topbar-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <div class="topbar-title">Data Buku</div>
                <div class="topbar-sub">Kelola data buku perpustakaan</div>
            </div>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-back">← Dashboard</a>
            <a href="{{ route('admin.buku.create') }}" class="btn-add">+ Tambah Buku</a>
        </div>
    </div>

    <!-- STATS BAR -->
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-dot" style="background: var(--ink);"></div>
            <div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-val">{{ $buku->count() }}</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-dot" style="background: #16a34a;"></div>
            <div>
                <div class="stat-label">Tersedia</div>
                <div class="stat-val" style="color: #16a34a;">{{ $buku->where('stok', '>', 5)->count() }}</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-dot" style="background: #b45309;"></div>
            <div>
                <div class="stat-label">Hampir Habis</div>
                <div class="stat-val" style="color: #b45309;">{{ $buku->whereBetween('stok', [1, 5])->count() }}</div>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-dot" style="background: #dc2626;"></div>
            <div>
                <div class="stat-label">Stok Habis</div>
                <div class="stat-val" style="color: #dc2626;">{{ $buku->where('stok', 0)->count() }}</div>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        @if(session('success'))
        <div class="alert-success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- TOOLBAR -->
        <div class="toolbar">
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="searchInput" class="search-input" placeholder="Cari judul, pengarang, penerbit…">
            </div>
            <div class="toolbar-right">
                <button class="filter-btn" onclick="window.print()">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Ekspor
                </button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-wrap">
            <div class="table-header">
                <span class="table-header-title">Daftar Koleksi Buku</span>
                <span class="table-count">{{ $buku->count() }} buku</span>
            </div>

            <div class="table-scroll">
                <table id="bukuTable">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Judul & Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @forelse($buku as $item)
                        
                        <tr>
                            <!-- Cover -->
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         class="book-cover-img"
                                         alt="Cover {{ $item->judul }}">
                                @else
                                    <div class="book-cover-placeholder">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                @endif
                            </td>

                            <!-- Nomor -->
                            <td><span class="td-num">{{ $loop->iteration }}</span></td>
                              <td>
        {{ $item->kategori->nama_kategori ?? '-' }}
    </td>
                            <!-- Judul & Pengarang -->
                            <td>
                                <div class="td-book">
                                    <div>
                                        <div class="td-book-title">{{ $item->judul }}</div>
                                        <div class="td-book-author">{{ $item->pengarang }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Penerbit -->
                            <td>{{ $item->penerbit }}</td>

                            <!-- Tahun -->
                            <td>{{ $item->tahun_terbit }}</td>

                            <!-- Stok -->
                            <td>
                                @if($item->stok > 5)
                                    <span class="badge badge-green">{{ $item->stok }} Tersedia</span>
                                @elseif($item->stok > 0)
                                    <span class="badge badge-yellow">{{ $item->stok }} Hampir Habis</span>
                                @else
                                    <span class="badge badge-red">Habis</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="center">
                                <div class="actions-cell">
                                    <a href="{{ route('admin.buku.edit', $item->id) }}" class="btn-edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.buku.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus buku ini?')" class="btn-delete">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                    Belum ada data buku. <a href="{{ route('admin.buku.create') }}" style="color: var(--accent); font-weight:500;">Tambah sekarang →</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer / Pagination -->
            @if($buku->count() > 0)
            <div class="table-footer">
                <span class="page-info">Menampilkan {{ $buku->count() }} entri</span>
                {{-- Jika pakai paginate(), ganti baris di atas dengan: --}}
                {{-- <span class="page-info">Menampilkan {{ $buku->firstItem() }}–{{ $buku->lastItem() }} dari {{ $buku->total() }} entri</span> --}}
                {{-- Dan ganti bagian pagination di bawah dengan: {{ $buku->links() }} --}}
                <div class="pagination">
                    <a class="page-btn">‹</a>
                    <a class="page-btn active">1</a>
                    <a class="page-btn">›</a>
                </div>
            </div>
            @endif
        </div>

    </div>
</main>

<script>
    /* Active sidebar link */
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });

    /* Live search filter */
    document.getElementById('searchInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#bukuTable tbody tr').forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    });
</script>

</body>
</html>