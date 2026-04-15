<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User — Perpustakaan Digital</title>
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
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOPBAR ── */
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

        .topbar-sub { font-size: 13px; color: var(--muted); margin-top: 2px; }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

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

        .topbar-date { text-align: right; margin-right: 8px; }
        .topbar-date-day { font-size: 11px; color: var(--muted); }
        .topbar-date-full { font-size: 13px; font-weight: 500; }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-add svg { width: 15px; height: 15px; }
        .btn-add:hover { background: #a8501f; box-shadow: 0 6px 20px rgba(200,98,42,0.3); transform: translateY(-1px); }

        /* ── CONTENT ── */
        .content { padding: 32px 36px; }

        /* Alert */
        .alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 18px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 24px;
            animation: fadeUp 0.4s ease both;
        }

        .alert svg { width: 16px; height: 16px; flex-shrink: 0; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

        /* ── MINI STATS ── */
        .mini-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .mini-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: transform 0.25s, box-shadow 0.25s;
            animation: fadeUp 0.4s ease both;
        }

        .mini-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(13,13,13,0.07); }
        .mini-card:nth-child(1) { animation-delay: 0s; }
        .mini-card:nth-child(2) { animation-delay: 0.07s; }
        .mini-card:nth-child(3) { animation-delay: 0.14s; }

        .mini-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mini-icon svg { width: 19px; height: 19px; }
        .mini-icon.purple { background: #f3e8ff; color: #7c3aed; }
        .mini-icon.blue   { background: #eff6ff; color: #3b82f6; }
        .mini-icon.green  { background: #f0fdf4; color: #22c55e; }

        .mini-num {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 900;
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .mini-label { font-size: 12px; color: var(--muted); margin-top: 3px; }

        /* ── FILTER BAR ── */
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
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 15px; height: 15px;
            color: var(--muted);
            pointer-events: none;
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
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(200,98,42,0.08); }

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

        /* ── TABLE PANEL ── */
        .table-panel {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            animation: fadeUp 0.5s ease 0.2s both;
        }

        .table-panel-header {
            padding: 18px 24px;
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

        .table-panel-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .count-pill {
            font-size: 11px;
            font-weight: 600;
            background: var(--cream);
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 4px 12px;
            border-radius: 100px;
        }

        .table-scroll { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; }

        thead tr {
            background: var(--cream);
            border-bottom: 1px solid var(--border);
        }

        thead th {
            padding: 13px 20px;
            text-align: left;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--muted);
            white-space: nowrap;
        }

        thead th.center { text-align: center; }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(200,98,42,0.03); }

        td { padding: 14px 20px; vertical-align: middle; font-size: 13.5px; }
        td.center { text-align: center; }

        /* No column */
        .td-no { color: var(--muted); font-size: 12px; font-weight: 500; }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 12px; }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-avatar.role-admin { background: #ede9fe; color: #7c3aed; }
        .user-avatar.role-user  { background: #f0f0ec; color: var(--muted); border: 1px solid var(--border); }

        .user-info {}
        .user-name { font-weight: 600; font-size: 13.5px; line-height: 1.3; }
        .user-joined { font-size: 11px; color: var(--muted); margin-top: 1px; }

        /* Email */
        .email-wrap {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 13px;
        }

        .email-wrap svg { width: 13px; height: 13px; flex-shrink: 0; }

        /* Role badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: 100px;
            white-space: nowrap;
        }

        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }

        .badge-admin { background: #f3e8ff; color: #7c3aed; }
        .badge-admin .badge-dot { background: #7c3aed; }

        .badge-user { background: var(--cream); color: var(--muted); border: 1px solid var(--border); }
        .badge-user .badge-dot { background: var(--muted); }

        /* Actions */
        .actions { display: flex; justify-content: center; gap: 6px; }

        .btn-edit, .btn-delete {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
        }

        .btn-edit svg, .btn-delete svg { width: 13px; height: 13px; }

        .btn-edit   { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
        .btn-edit:hover { background: #b45309; color: white; border-color: #b45309; transform: translateY(-1px); }

        .btn-delete { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .btn-delete:hover { background: #dc2626; color: white; border-color: #dc2626; transform: translateY(-1px); }

        /* Empty */
        .empty-state {
            padding: 70px 40px;
            text-align: center;
            color: var(--muted);
        }

        .empty-icon {
            width: 64px; height: 64px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-icon svg { width: 28px; height: 28px; opacity: 0.35; }
        .empty-state h3 { font-size: 15px; font-weight: 600; color: var(--ink); margin-bottom: 6px; }
        .empty-state p { font-size: 13px; }

        /* Pagination */
        .table-footer {
            padding: 14px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-footer-info { font-size: 12px; color: var(--muted); }

        /* Row highlight for admin */
        tbody tr[data-role="admin"] td:first-child {
            border-left: 3px solid #7c3aed;
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        form { margin: 0; }
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

        <a href="{{ route('admin.users.index') }}" class="sidebar-link active">
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

<!-- ── MAIN ── -->
<main class="main">

    <!-- Topbar -->
    <div class="topbar">
        <div>
            <div class="topbar-title">Kelola User</div>
            <div class="topbar-sub">Manajemen akun pengguna sistem</div>
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
            <a href="{{ route('admin.users.create') }}" class="btn-add">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah User
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Alert -->
        @if(session('success'))
            <div class="alert alert-success">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Mini Stats -->
        <div class="mini-stats">
            <div class="mini-card">
                <div class="mini-icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $users->count() }}</div>
                    <div class="mini-label">Total Pengguna</div>
                </div>
            </div>

            <div class="mini-card">
                <div class="mini-icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $users->where('role','admin')->count() }}</div>
                    <div class="mini-label">Administrator</div>
                </div>
            </div>

            <div class="mini-card">
                <div class="mini-icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <div class="mini-num">{{ $users->where('role','user')->count() }}</div>
                    <div class="mini-label">Anggota Biasa</div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari nama atau email pengguna...">
            </div>
            <select class="filter-select" id="roleFilter">
                <option value="">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <!-- Table -->
        <div class="table-panel">
            <div class="table-panel-header">
                <div>
                    <div class="table-panel-title">Daftar Pengguna</div>
                    <div class="table-panel-sub">Seluruh akun yang terdaftar di sistem</div>
                </div>
                <span class="count-pill" id="countPill">{{ $users->count() }} user</span>
            </div>

            <div class="table-scroll">
                @if($users->count())
                <table id="userTable">
                    <thead>
                        <tr>
                            <th style="width:48px;">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="user-row"
                            data-role="{{ $user->role }}"
                            data-search="{{ strtolower($user->name . ' ' . $user->email) }}"
                            data-role-val="{{ $user->role }}">

                            <!-- No -->
                            <td class="td-no">{{ $loop->iteration }}</td>

                            <!-- Nama -->
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar {{ $user->role == 'admin' ? 'role-admin' : 'role-user' }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-info">
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-joined">Bergabung {{ $user->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Email -->
                            <td>
                                <div class="email-wrap">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    {{ $user->email }}
                                </div>
                            </td>

                            <!-- Role -->
                            <td>
                                <span class="badge {{ $user->role == 'admin' ? 'badge-admin' : 'badge-user' }}">
                                    <span class="badge-dot"></span>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="center">
                                <div class="actions">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn-edit">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    </div>
                    <h3>Belum ada pengguna</h3>
                    <p>Tambahkan akun user pertama menggunakan tombol di atas</p>
                </div>
                @endif
            </div>

            @if($users->count())
            <div class="table-footer">
                <div class="table-footer-info" id="footerInfo">Menampilkan {{ $users->count() }} pengguna</div>
            </div>
            @endif
        </div>

    </div>
</main>

<script>
    // ── Search & Filter ──
    const searchInput = document.getElementById('searchInput');
    const roleFilter  = document.getElementById('roleFilter');
    const rows        = document.querySelectorAll('.user-row');
    const countPill   = document.getElementById('countPill');
    const footerInfo  = document.getElementById('footerInfo');

    function filterTable() {
        const q    = searchInput.value.toLowerCase();
        const role = roleFilter.value.toLowerCase();
        let visible = 0;

        rows.forEach(row => {
            const matchSearch = row.dataset.search.includes(q);
            const matchRole   = !role || row.dataset.roleVal === role;
            const show = matchSearch && matchRole;
            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (countPill)  countPill.textContent  = visible + ' user';
        if (footerInfo) footerInfo.textContent  = 'Menampilkan ' + visible + ' pengguna';
    }

    searchInput?.addEventListener('input', filterTable);
    roleFilter?.addEventListener('change', filterTable);

    // ── Active sidebar link ──
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