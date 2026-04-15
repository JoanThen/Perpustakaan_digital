<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi — Perpustakaan Digital</title>
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
            --sidebar-w: 240px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
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

        .sidebar-link:hover {
            background: rgba(255,255,255,0.07);
            color: white;
        }

        .sidebar-link.active {
            background: var(--accent);
            color: white;
        }

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

        .sidebar-user-name {
            font-size: 13px;
            font-weight: 500;
            color: white;
            line-height: 1.2;
        }

        .sidebar-user-role {
            font-size: 11px;
            color: rgba(255,255,255,0.35);
        }

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

        .btn-logout:hover {
            background: rgba(200,98,42,0.2);
            color: var(--accent-light);
            border-color: rgba(200,98,42,0.3);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: var(--paper);
            border-bottom: 1px solid var(--border);
            padding: 20px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -0.8px;
        }

        .topbar-sub {
            font-size: 13px;
            color: var(--muted);
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notif-btn {
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--muted);
            padding: 6px;
            border-radius: 8px;
            transition: color 0.2s;
        }

        .notif-btn:hover { color: var(--ink); }
        .notif-btn svg { width: 20px; height: 20px; display: block; }

        .notif-dot {
            position: absolute;
            top: 4px; right: 4px;
            width: 7px; height: 7px;
            background: var(--accent);
            border-radius: 50%;
            border: 1.5px solid var(--paper);
        }

        .topbar-date { text-align: right; }
        .topbar-date-day { font-size: 11px; color: var(--muted); }
        .topbar-date-full { font-size: 13px; font-weight: 500; }

        /* ── CONTENT ── */
        .content { padding: 32px 36px; }

        /* Filter bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--muted);
        }

        .search-input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: var(--accent);
        }

        .filter-select {
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            outline: none;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .filter-select:focus { border-color: var(--accent); }

        /* Stats mini */
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .mini-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mini-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mini-icon svg { width: 18px; height: 18px; }
        .mini-icon.blue   { background: #eff6ff; color: #3b82f6; }
        .mini-icon.orange { background: #fff7ed; color: #f97316; }
        .mini-icon.green  { background: #f0fdf4; color: #22c55e; }

        .mini-num {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .mini-label {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* Table panel */
        .table-panel {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .table-panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 700;
        }

        .table-panel-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 14px 20px;
            background: var(--cream);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 13.5px;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }

        tbody tr {
            transition: background 0.15s;
        }

        tbody tr:hover { background: rgba(200,98,42,0.03); }

        /* Cover img */
        .book-cover {
            width: 44px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .cover-placeholder {
            width: 44px;
            height: 60px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
        }

        .cover-placeholder svg { width: 18px; height: 18px; }

        /* User cell */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 30px; height: 30px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .user-name { font-weight: 500; }

        /* Badge status */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
        }

        .badge.dipinjam {
            background: #fff7ed;
            color: #ea580c;
        }

        .badge.dipinjam .badge-dot { background: #ea580c; }

        .badge.kembali {
            background: #ecfdf5;
            color: #16a34a;
        }

        .badge.kembali .badge-dot { background: #16a34a; }

        /* Date cell */
        .date-cell { white-space: nowrap; }
        .date-main { font-weight: 500; }
        .date-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }

        /* Action button */
        .btn-return {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-return svg { width: 13px; height: 13px; }

        .btn-return:hover {
            background: #a8501f;
            transform: translateY(-1px);
        }

        .status-done {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--muted);
        }

        .status-done svg { width: 13px; height: 13px; color: #22c55e; }

        /* Empty state */
        .empty-state {
            padding: 60px 40px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state svg {
            width: 48px; height: 48px;
            opacity: 0.25;
            margin-bottom: 12px;
        }

        .empty-state p { font-size: 14px; }

        /* Pagination */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info {
            font-size: 12px;
            color: var(--muted);
        }

        .pagination-links {
            display: flex;
            gap: 6px;
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .mini-card { animation: fadeUp 0.4s ease both; }
        .mini-card:nth-child(1) { animation-delay: 0s; }
        .mini-card:nth-child(2) { animation-delay: 0.07s; }
        .mini-card:nth-child(3) { animation-delay: 0.14s; }

        .table-panel { animation: fadeUp 0.5s ease 0.2s both; }
    </style>
</head>
<body>

<!-- ── SIDEBAR ── -->
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

        <a href="{{ route('admin.transaksi.index') }}" class="sidebar-link active">
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

<!-- ── MAIN ── -->
<main class="main">

    <!-- Topbar -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Manajemen Transaksi</div>
            <div class="topbar-sub">Kelola semua aktivitas peminjaman buku</div>
        </div>
        <div class="topbar-right">
            <button class="notif-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span class="notif-dot"></span>
            </button>
            <div class="topbar-date">
                <div class="topbar-date-day">{{ date('l') }}</div>
                <div class="topbar-date-full">{{ date('d M Y') }}</div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Mini Stats -->
        <div class="mini-stats">
            <div class="mini-card">
                <div class="mini-icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $transaksi->count() }}</div>
                    <div class="mini-label">Total Transaksi</div>
                </div>
            </div>

            <div class="mini-card">
                <div class="mini-icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $transaksi->where('status','dipinjam')->count() }}</div>
                    <div class="mini-label">Sedang Dipinjam</div>
                </div>
            </div>

            <div class="mini-card">
                <div class="mini-icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $transaksi->where('status','kembali')->count() }}</div>
                    <div class="mini-label">Sudah Dikembalikan</div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" class="search-input" placeholder="Cari nama user atau judul buku..." id="searchInput">
            </div>
            <select class="filter-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="dipinjam">Dipinjam</option>
                <option value="kembali">Dikembalikan</option>
            </select>
        </div>

        <!-- Table -->
        <div class="table-panel">
            <div class="table-panel-header">
                <div>
                    <div class="table-panel-title">Daftar Transaksi</div>
                    <div class="table-panel-sub">Riwayat lengkap peminjaman & pengembalian buku</div>
                </div>
            </div>

            <div class="table-wrap">
                @if($transaksi->count())
                    <table id="mainTable">
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>#</th>
                                <th>Nama User</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                                <tr class="table-row" data-status="{{ $item->status }}" data-search="{{ strtolower(($item->user->name ?? '') . ' ' . ($item->buku->judul ?? '')) }}">
                                    <!-- Cover -->
                                    <td>
                                        @if($item->buku && $item->buku->image)
                                            <img src="{{ asset('storage/' . $item->buku->image) }}"
                                                 class="book-cover" alt="Cover">
                                        @else
                                            <div class="cover-placeholder">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- No -->
                                    <td style="color:var(--muted);font-size:13px;">{{ $loop->iteration }}</td>

                                    <!-- User -->
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                            </div>
                                            <div class="user-name">{{ $item->user->name ?? '-' }}</div>
                                        </div>
                                    </td>

                                    <!-- Buku -->
                                    <td style="font-weight:500;">{{ $item->buku->judul ?? '-' }}</td>

                                    <!-- Tanggal Pinjam -->
                                    <td class="date-cell">
                                        <div class="date-main">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>
                                        <div class="date-sub">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('H:i') }}</div>
                                    </td>

                                    <!-- Tanggal Kembali -->
                                    <td class="date-cell">
                                        @if($item->tanggal_kembali)
                                            <div class="date-main">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</div>
                                            <div class="date-sub">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('H:i') }}</div>
                                        @else
                                            <span style="color:var(--muted);font-size:12px;">—</span>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        <span class="badge {{ $item->status == 'dipinjam' ? 'dipinjam' : 'kembali' }}">
                                            <span class="badge-dot"></span>
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <!-- Aksi -->
                                    <td>
                                        @if($item->status == 'dipinjam')
                                            <form action="{{ route('transaksi.kembali', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn-return">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="status-done">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <p>Belum ada transaksi yang tercatat</p>
                    </div>
                @endif
            </div>

            @if($transaksi->count())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Menampilkan {{ $transaksi->count() }} transaksi
                </div>
                {{-- Jika pakai paginate(), ganti baris di atas dengan: --}}
                {{-- {{ $transaksi->links() }} --}}
            </div>
            @endif
        </div>

    </div>
</main>

<script>
    // ── Search & Filter ──
    const searchInput   = document.getElementById('searchInput');
    const statusFilter  = document.getElementById('statusFilter');
    const rows          = document.querySelectorAll('.table-row');

    function filterTable() {
        const q      = searchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        rows.forEach(row => {
            const matchSearch = row.dataset.search.includes(q);
            const matchStatus = !status || row.dataset.status === status;
            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // ── Active link highlight ──
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