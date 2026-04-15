<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman — Perpustakaan Digital</title>
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
            transition: all 0.15s;
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

        .topbar-actions { display: flex; gap: 10px; align-items: center; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: none; border: 1px solid var(--border);
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; color: var(--muted);
            text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 18px; background: var(--ink); color: white;
            border: none; border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.2s; cursor: pointer;
        }
        .btn-primary:hover { background: var(--accent); box-shadow: 0 6px 20px rgba(200,98,42,0.28); }
        .btn-primary svg { width: 14px; height: 14px; }

        /* ── CONTENT ── */
        .content { padding: 28px 36px; flex: 1; }

        /* ── ALERT ── */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            background: #f0fdf4; border: 1px solid #c3e6c3; border-left: 3px solid #16a34a;
            color: #16a34a; padding: 12px 16px; border-radius: 10px;
            font-size: 13px; margin-bottom: 20px;
        }
        .alert-success svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* ── STATS ── */
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 24px; }

        .stat-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 14px; padding: 18px 20px;
            display: flex; align-items: center; gap: 14px;
        }
        .stat-icon {
            width: 40px; height: 40px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-icon svg { width: 18px; height: 18px; }
        .stat-label { font-size: 11px; color: var(--muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.8px; }
        .stat-value { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 900; line-height: 1.1; letter-spacing: -0.8px; }

        /* ── FILTER BAR ── */
        .filter-bar {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px;
        }
        .filter-search-wrap { position: relative; flex: 1; max-width: 320px; }
        .filter-search-wrap svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px; stroke: var(--muted); pointer-events: none; }
        .filter-search-input {
            width: 100%; padding: 9px 12px 9px 34px;
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 9px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; color: var(--ink); outline: none; transition: all 0.18s;
        }
        .filter-search-input::placeholder { color: rgba(138,128,112,0.5); }
        .filter-search-input:focus { border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(200,98,42,0.07); }

        .filter-tabs { display: flex; gap: 6px; }
        .filter-tab {
            padding: 8px 16px; border-radius: 100px; font-size: 12px; font-weight: 500;
            border: 1px solid var(--border); background: var(--paper);
            color: var(--muted); cursor: pointer; transition: all 0.18s; font-family: 'DM Sans', sans-serif;
        }
        .filter-tab:hover { border-color: var(--ink); color: var(--ink); }
        .filter-tab.active { background: var(--ink); color: white; border-color: var(--ink); }
        .filter-tab.tab-dipinjam.active { background: #b45309; border-color: #b45309; }
        .filter-tab.tab-kembali.active { background: #16a34a; border-color: #16a34a; }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
        }

        .table-card-header {
            padding: 16px 20px; border-bottom: 1px solid var(--border);
            background: white; display: flex; align-items: center; justify-content: space-between;
        }
        .table-card-title { font-size: 13px; font-weight: 500; color: var(--ink); }
        .table-card-count { font-size: 11px; color: var(--muted); }

        .table-scroll { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 13px; }

        thead tr { background: var(--cream); border-bottom: 1px solid var(--border); }
        thead th {
            padding: 11px 18px; text-align: left;
            font-size: 10.5px; font-weight: 500;
            letter-spacing: 1px; text-transform: uppercase; color: var(--muted);
            white-space: nowrap;
        }
        thead th.center { text-align: center; }

        tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--cream); }
        tbody tr.hidden-row { display: none; }

        td { padding: 14px 18px; vertical-align: middle; }
        td.center { text-align: center; }

        /* Book cover mini */
        .cover-wrap {
            width: 40px; height: 54px; border-radius: 6px; flex-shrink: 0;
            overflow: hidden; border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
        }
        .cover-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .cover-placeholder {
            width: 100%; height: 100%;
            display: flex; align-items: center; justify-content: center;
        }
        .cover-placeholder svg { width: 16px; height: 16px; stroke: rgba(255,255,255,0.5); }

        .bc-1 { background: linear-gradient(135deg,#3b4a6b,#2a3555); }
        .bc-2 { background: linear-gradient(135deg,#c8622a,#a04d1f); }
        .bc-3 { background: linear-gradient(135deg,#5a6e4a,#3d4f31); }
        .bc-4 { background: linear-gradient(135deg,#8a6a3a,#6b4f28); }
        .bc-5 { background: linear-gradient(135deg,#4a5a7a,#364470); }
        .bc-6 { background: linear-gradient(135deg,#7a4a6a,#5e3450); }
        .bc-7 { background: linear-gradient(135deg,#4a7a6a,#346050); }
        .bc-8 { background: linear-gradient(135deg,#6a4a3a,#4e342a); }

        .book-title { font-weight: 500; font-size: 13px; color: var(--ink); }
        .book-author { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .user-chip { display: flex; align-items: center; gap: 8px; }
        .user-avatar {
            width: 26px; height: 26px; border-radius: 50%; background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 700; color: white; flex-shrink: 0;
        }
        .user-label { font-size: 13px; font-weight: 500; }

        /* Badges */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 100px; font-size: 11px; font-weight: 500;
        }
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: 0.6; }
        .badge-yellow { background: #fefce8; color: #b45309; }
        .badge-green  { background: #f0fdf4; color: #16a34a; }

        .date-primary { font-size: 13px; font-weight: 500; }
        .date-secondary { font-size: 11px; color: var(--muted); margin-top: 1px; }

        /* Return button */
        .btn-return {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            background: #eff6ff; color: #3b82f6;
            border: 1px solid #bfdbfe; transition: all 0.2s; cursor: pointer;
        }
        .btn-return:hover { background: #3b82f6; color: white; border-color: #3b82f6; }
        .btn-return svg { width: 12px; height: 12px; }

        /* Empty state */
        .empty-state {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 60px 20px; color: var(--muted); gap: 10px;
        }
        .empty-state svg { width: 40px; height: 40px; stroke: var(--muted); opacity: 0.3; }
        .empty-state-title { font-size: 14px; font-weight: 500; color: var(--ink); }
        .empty-state-sub { font-size: 12px; }

        /* No result (JS filter) */
        .no-result-row td { text-align: center; padding: 40px; color: var(--muted); font-size: 13px; }
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
        <a href="{{ route('user.buku.cari') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Buku
        </a>

        <div class="nav-section">Peminjaman</div>

        <a href="{{ route('transaksi.index') }}" class="nav-link active">
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
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div>
                <div class="topbar-title">Riwayat Peminjaman</div>
                <div class="topbar-sub">Data peminjaman dan pengembalian buku</div>
            </div>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('user.dashboard') }}" class="btn-back">← Dashboard</a>
            <a href="{{ route('transaksi.create') }}" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                Pinjam Buku
            </a>
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

        <!-- STATS -->
        @php
            $totalPinjam    = $transaksi->count();
            $sedangDipinjam = $transaksi->where('status','dipinjam')->count();
            $sudahKembali   = $transaksi->where('status','dikembalikan')->count();
        @endphp

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0ebe0;">
                    <svg fill="none" stroke="var(--muted)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <div class="stat-label">Total Transaksi</div>
                    <div class="stat-value">{{ $totalPinjam }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#fefce8;">
                    <svg fill="none" stroke="#b45309" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="stat-label">Sedang Dipinjam</div>
                    <div class="stat-value" style="color:#b45309;">{{ $sedangDipinjam }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="stat-label">Sudah Dikembalikan</div>
                    <div class="stat-value" style="color:#16a34a;">{{ $sudahKembali }}</div>
                </div>
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <div class="filter-search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="searchInput" class="filter-search-input" placeholder="Cari buku atau pengguna…">
            </div>
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab tab-dipinjam" data-filter="dipinjam">Dipinjam</button>
                <button class="filter-tab tab-kembali" data-filter="dikembalikan">Dikembalikan</button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">Daftar Transaksi</div>
                <div class="table-card-count" id="rowCount">{{ $totalPinjam }} entri</div>
            </div>

            @if($transaksi->isEmpty())
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <div class="empty-state-title">Belum ada transaksi</div>
                <div class="empty-state-sub">Mulai dengan meminjam buku pertamamu</div>
            </div>
            @else
            <div class="table-scroll">
                <table id="mainTable">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $i => $item)
                        @php
                            $colors = ['bc-1','bc-2','bc-3','bc-4','bc-5','bc-6','bc-7','bc-8'];
                            $color  = $colors[$i % count($colors)];
                        @endphp
                        <tr data-status="{{ $item->status }}"
                            data-search="{{ strtolower($item->buku->judul . ' ' . $item->user->name) }}">
                            <td>
                                <div class="cover-wrap {{ !($item->buku && $item->buku->image) ? $color : '' }}">
                                    @if($item->buku && $item->buku->image)
                                        <img src="{{ asset('storage/' . $item->buku->image) }}" alt="{{ $item->buku->judul }}">
                                    @else
                                        <div class="cover-placeholder">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="book-title">{{ $item->buku->judul }}</div>
                                <div class="book-author">{{ $item->buku->pengarang ?? '—' }}</div>
                            </td>
                            <td>
                                <div class="user-chip">
                                    <div class="user-avatar">{{ strtoupper(substr($item->user->name, 0, 1)) }}</div>
                                    <span class="user-label">{{ $item->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="date-primary">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>
                                <div class="date-secondary">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->diffForHumans() }}</div>
                            </td>
                            <td>
                                @if($item->status == 'dipinjam')
                                    <span class="badge badge-yellow">Dipinjam</span>
                                @else
                                    <span class="badge badge-green">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="center">
                                @if($item->status == 'dipinjam')
                                    <form action="{{ route('transaksi.kembali', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-return">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                            Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span style="color:var(--muted); font-size:12px;">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="no-result-row" id="noResultRow" style="display:none;">
                            <td colspan="6">Tidak ada transaksi yang cocok.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>

    </div>
</main>

<script>
    /* Filter tabs */
    const tabs = document.querySelectorAll('.filter-tab');
    let activeFilter = 'all';

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            activeFilter = tab.dataset.filter;
            applyFilters();
        });
    });

    /* Search */
    document.getElementById('searchInput')?.addEventListener('input', function () {
        applyFilters();
    });

    function applyFilters() {
        const q = (document.getElementById('searchInput')?.value || '').toLowerCase();
        const rows = document.querySelectorAll('#mainTable tbody tr:not(.no-result-row)');
        let visible = 0;

        rows.forEach(row => {
            const matchSearch = q === '' || row.dataset.search.includes(q);
            const matchFilter = activeFilter === 'all' || row.dataset.status === activeFilter;
            const show = matchSearch && matchFilter;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        const noResult = document.getElementById('noResultRow');
        if (noResult) noResult.style.display = visible === 0 ? '' : 'none';

        const rowCount = document.getElementById('rowCount');
        if (rowCount) rowCount.textContent = visible + ' entri';
    }
</script>

</body>
</html>