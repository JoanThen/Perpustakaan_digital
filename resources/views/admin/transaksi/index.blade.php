<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi — Perpustakaan Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            --radius: 12px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            font-size: 14px;
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
        .content { padding: 32px 36px 48px; }

        /* Mini Stats */
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .mini-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow 0.2s;
        }

        .mini-card:hover {
            box-shadow: 0 4px 20px rgba(13,13,13,0.07);
        }

        .mini-icon {
            width: 44px; height: 44px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mini-icon svg { width: 20px; height: 20px; }
        .mini-icon.blue   { background: #eff6ff; color: #3b82f6; }
        .mini-icon.orange { background: #fff7ed; color: #f97316; }
        .mini-icon.green  { background: #f0fdf4; color: #22c55e; }

        .mini-num {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .mini-label {
            font-size: 12px;
            color: var(--muted);
            margin-top: 3px;
            font-weight: 500;
        }

        /* Filter Bar */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 220px;
        }

        .search-wrap svg {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            color: var(--muted);
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--paper);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            color: var(--ink);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input::placeholder { color: var(--muted); }

        .search-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(200,98,42,0.1);
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
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(200,98,42,0.1);
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-export svg { width: 15px; height: 15px; }

        .btn-export:hover {
            background: #a8501f;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(200,98,42,0.3);
        }

        /* Table Panel */
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

        .table-count-badge {
            background: rgba(13,13,13,0.06);
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 999px;
        }

        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            padding: 13px 20px;
            background: rgba(13,13,13,0.025);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(13,13,13,0.06);
            font-size: 13px;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }

        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(200,98,42,0.03); }

        /* Book cover */
        .book-cover {
            width: 40px;
            height: 56px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15), 2px 0 0 rgba(0,0,0,0.05);
            display: block;
        }

        .cover-placeholder {
            width: 40px;
            height: 56px;
            background: rgba(13,13,13,0.05);
            border: 1px solid var(--border);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
        }

        .cover-placeholder svg { width: 16px; height: 16px; }

        /* User cell */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }

        .user-name { font-weight: 500; font-size: 13px; }
        .user-email { font-size: 11px; color: var(--muted); margin-top: 1px; }

        /* Book title */
        .book-title {
            font-weight: 500;
            font-size: 13px;
            line-height: 1.4;
            max-width: 180px;
        }

        /* Date cell */
        .date-cell { white-space: nowrap; }
        .date-main { font-weight: 500; font-size: 13px; }
        .date-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }
        .date-late { font-size: 11px; color: #dc2626; margin-top: 2px; font-weight: 600; }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            letter-spacing: 0.2px;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .badge.dipinjam  { background: #fff7ed; color: #c2410c; }
        .badge.dipinjam .badge-dot { background: #f97316; }

        .badge.kembali   { background: #ecfdf5; color: #15803d; }
        .badge.kembali .badge-dot { background: #22c55e; }

        .badge.pending   { background: #fefce8; color: #a16207; }
        .badge.pending .badge-dot { background: #eab308; }

        .badge.ditolak   { background: #fef2f2; color: #b91c1c; }
        .badge.ditolak .badge-dot { background: #ef4444; }

        /* Action buttons */
        .action-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border: none;
            border-radius: 7px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-action svg { width: 12px; height: 12px; }

        .btn-approve {
            background: #dcfce7;
            color: #15803d;
        }

        .btn-approve:hover {
            background: #bbf7d0;
            transform: translateY(-1px);
        }

        .btn-reject {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-reject:hover {
            background: #fecaca;
            transform: translateY(-1px);
        }

        .status-done {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        .status-done svg { width: 14px; height: 14px; color: #22c55e; }

        /* Empty state */
        .empty-state {
            padding: 80px 40px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state-icon {
            width: 64px; height: 64px;
            background: rgba(13,13,13,0.04);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-state-icon svg { width: 28px; height: 28px; opacity: 0.3; }
        .empty-state h3 { font-size: 16px; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
        .empty-state p { font-size: 13px; }

        /* Pagination */
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-info { font-size: 12px; color: var(--muted); }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .mini-card { animation: fadeUp 0.4s ease both; }
        .mini-card:nth-child(1) { animation-delay: 0s; }
        .mini-card:nth-child(2) { animation-delay: 0.07s; }
        .mini-card:nth-child(3) { animation-delay: 0.14s; }
        .filter-bar { animation: fadeUp 0.4s ease 0.15s both; }
        .table-panel { animation: fadeUp 0.5s ease 0.2s both; }

        /* Print */
        @media print {
            .sidebar, .topbar, .filter-bar, .btn-export, .action-group { display: none !important; }
            .main { margin-left: 0; }
            .table-panel { border: none; box-shadow: none; }
        }
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

        <a href="{{ route('admin.kategori.index') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
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

        <a href="{{ route('admin.transaksi.index') }}" class="sidebar-link active">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
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
                    <div class="mini-num">{{ $transaksi->where('status','dikembalikan')->count() }}</div>
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
                <option value="pending">Pending</option>
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
                <option value="ditolak">Ditolak</option>
            </select>
            <button class="btn-export" onclick="window.print()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Ekspor PDF
            </button>
        </div>

        <!-- Table Panel -->
        <div class="table-panel">
            <div class="table-panel-header">
                <div>
                    <div class="table-panel-title">Daftar Transaksi</div>
                    <div class="table-panel-sub">Riwayat lengkap peminjaman &amp; pengembalian buku</div>
                </div>
                @if($transaksi->count())
                    <span class="table-count-badge">{{ $transaksi->count() }} transaksi</span>
                @endif
            </div>

            <div class="table-wrap">
                @if($transaksi->count())
                    <table id="mainTable">
                        <thead>
                            <tr>
                                <th style="width:52px;">Cover</th>
                                <th style="width:36px;">#</th>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $item)
                                <tr class="table-row"
                                    data-status="{{ $item->status }}"
                                    data-search="{{ strtolower(($item->user->name ?? '') . ' ' . ($item->buku->judul ?? '')) }}">

                                    <!-- Cover -->
                                    <td>
                                        @if($item->buku && $item->buku->image)
                                            <img src="{{ asset('storage/' . $item->buku->image) }}" class="book-cover" alt="Cover">
                                        @else
                                            <div class="cover-placeholder">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- No -->
                                    <td style="color:var(--muted);font-weight:600;font-size:12px;">{{ $loop->iteration }}</td>

                                    <!-- Peminjam -->
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">{{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}</div>
                                            <div>
                                                <div class="user-name">{{ $item->user->name ?? '-' }}</div>
                                                @if(isset($item->user->email))
                                                    <div class="user-email">{{ $item->user->email }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Buku -->
                                    <td>
                                        <div class="book-title">{{ $item->buku->judul ?? '-' }}</div>
                                        @if(isset($item->buku->penulis))
                                            <div class="date-sub">{{ $item->buku->penulis }}</div>
                                        @endif
                                    </td>

                                    <!-- Tgl Pinjam -->
                                    <td class="date-cell">
                                        @if($item->status != 'pending')
                                            <div class="date-main">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</div>
                                            <div class="date-sub">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('H:i') }}</div>
                                        @else
                                            <div class="date-sub" style="font-style:italic;">Menunggu approval</div>
                                        @endif
                                    </td>

                                    <!-- Batas Kembali -->
                                    <td class="date-cell">
                                        @if($item->tanggal_kembali_rencana)
                                            @php
                                                $isLate = now()->gt($item->tanggal_kembali_rencana) && $item->status == 'dipinjam';
                                                $lateDays = $isLate ? now()->diffInDays($item->tanggal_kembali_rencana) : 0;
                                            @endphp
                                            <div class="date-main" style="{{ $isLate ? 'color:#dc2626;' : '' }}">
                                                {{ \Carbon\Carbon::parse($item->tanggal_kembali_rencana)->format('d M Y') }}
                                            </div>
                                            @if($isLate)
                                                <div class="date-late">Terlambat {{ $lateDays }}h</div>
                                            @else
                                                <div class="date-sub">Batas waktu</div>
                                            @endif
                                        @else
                                            <span class="date-sub">—</span>
                                        @endif
                                    </td>

                                    <!-- Tgl Kembali -->
                                    <td class="date-cell">
                                        @if($item->tanggal_kembali)
                                            <div class="date-main">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</div>
                                            <div class="date-sub">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('H:i') }}</div>
                                        @else
                                            <span class="date-sub">Belum kembali</span>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if($item->status == 'pending')
                                            <span class="badge pending">
                                                <span class="badge-dot"></span>Pending
                                            </span>
                                        @elseif($item->status == 'dipinjam')
                                            <span class="badge dipinjam">
                                                <span class="badge-dot"></span>Dipinjam
                                            </span>
                                        @elseif($item->status == 'dikembalikan')
                                            <span class="badge kembali">
                                                <span class="badge-dot"></span>Dikembalikan
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="badge ditolak">
                                                <span class="badge-dot"></span>Ditolak
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Aksi -->
                                    <td>
                                        @if($item->status == 'pending')
                                            <div class="action-group">
                                                <form action="{{ route('admin.transaksi.approve', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-approve">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.transaksi.tolak', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-reject">
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($item->status == 'dipinjam')
                                            <span class="date-sub" style="font-style:italic;">Sedang dipinjam</span>
                                        @elseif($item->status == 'dikembalikan')
                                            <span class="status-done">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                Selesai
                                            </span>
                                        @elseif($item->status == 'ditolak')
                                            <span class="date-sub" style="color:#b91c1c;">Ditolak</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <h3>Belum ada transaksi</h3>
                        <p>Transaksi peminjaman buku akan muncul di sini</p>
                    </div>
                @endif
            </div>

            @if($transaksi->count())
            <div class="pagination-wrap">
                <div class="pagination-info" id="paginationInfo">
                    Menampilkan {{ $transaksi->count() }} transaksi
                </div>
            </div>
            @endif
        </div>

    </div>
</main>

<script>
    const searchInput  = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const rows         = document.querySelectorAll('.table-row');
    const infoEl       = document.getElementById('paginationInfo');

    function filterTable() {
        const q      = searchInput.value.toLowerCase().trim();
        const status = statusFilter.value.toLowerCase();
        let visible  = 0;

        rows.forEach(row => {
            const matchSearch = !q || row.dataset.search.includes(q);
            const matchStatus = !status || row.dataset.status === status;
            const show = matchSearch && matchStatus;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (infoEl) {
            infoEl.textContent = visible === rows.length
                ? `Menampilkan ${rows.length} transaksi`
                : `Menampilkan ${visible} dari ${rows.length} transaksi`;
        }
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

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