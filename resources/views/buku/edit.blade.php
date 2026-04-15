<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku — Perpustakaan Digital</title>
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

        .topbar-icon {
            width: 40px; height: 40px; background: var(--accent);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
        }
        .topbar-icon svg { width: 18px; height: 18px; stroke: white; }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 900; letter-spacing: -0.6px; line-height: 1.1;
        }
        .topbar-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .topbar-actions { display: flex; align-items: center; gap: 10px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: none;
            border: 1px solid var(--border); border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            color: var(--muted); text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: var(--muted);
            padding: 10px 36px;
            background: var(--paper);
            border-bottom: 1px solid var(--border);
        }
        .breadcrumb a { color: var(--muted); text-decoration: none; transition: color 0.15s; }
        .breadcrumb a:hover { color: var(--ink); }
        .breadcrumb-sep { opacity: 0.4; }
        .breadcrumb-current { color: var(--ink); font-weight: 500; }

        /* ── CONTENT ── */
        .content {
            padding: 28px 36px;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
            max-width: 1000px;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
        }

        .form-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: white;
            display: flex; align-items: center; gap: 10px;
        }

        .form-card-header-icon {
            width: 32px; height: 32px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .form-card-header-icon svg { width: 15px; height: 15px; stroke: var(--muted); }

        .form-card-title { font-size: 13px; font-weight: 500; color: var(--ink); }
        .form-card-subtitle { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .form-body { padding: 22px 24px; }

        /* ── FORM ELEMENTS ── */
        .form-group { margin-bottom: 16px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px; }

        .field-label {
            display: flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 500;
            letter-spacing: 0.8px; text-transform: uppercase;
            color: var(--muted); margin-bottom: 7px;
        }

        .required-dot {
            width: 5px; height: 5px;
            background: var(--accent); border-radius: 50%;
        }

        .field-input {
            width: 100%; padding: 11px 14px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--ink);
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 10px; outline: none; transition: all 0.2s;
        }
        .field-input::placeholder { color: rgba(138,128,112,0.45); }
        .field-input:focus {
            border-color: var(--accent); background: white;
            box-shadow: 0 0 0 3px rgba(200,98,42,0.08);
        }
        .field-input.is-error { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }

        .field-error { font-size: 11px; color: #dc2626; margin-top: 5px; }

        /* ── COVER SECTION ── */
        .cover-section { display: flex; gap: 16px; align-items: flex-start; }

        .current-cover {
            flex-shrink: 0;
            position: relative;
        }

        .current-cover-img {
            width: 72px; height: 96px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            display: block;
            box-shadow: 2px 4px 12px rgba(13,13,13,0.1);
        }

        .current-cover-placeholder {
            width: 72px; height: 96px;
            border-radius: 8px;
            background: linear-gradient(135deg, #e8e0d4 0%, #d4c8b8 100%);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
        }
        .current-cover-placeholder svg { width: 24px; height: 24px; stroke: var(--muted); opacity: 0.5; }

        .cover-badge {
            position: absolute; bottom: -6px; left: 50%; transform: translateX(-50%);
            background: var(--ink); color: white;
            font-size: 9px; font-weight: 500; letter-spacing: 0.5px;
            padding: 2px 8px; border-radius: 100px;
            white-space: nowrap;
        }

        .cover-upload-wrap { flex: 1; }

        .upload-zone {
            border: 1.5px dashed var(--border);
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: var(--cream);
        }
        .upload-zone:hover { border-color: var(--accent); background: rgba(200,98,42,0.02); }
        .upload-zone.has-file { border-color: #16a34a; background: #f0fdf4; }
        .upload-zone input[type="file"] {
            position: absolute; inset: 0; opacity: 0;
            cursor: pointer; width: 100%; height: 100%;
        }

        .upload-icon {
            width: 36px; height: 36px;
            background: white; border: 1px solid var(--border);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 8px;
        }
        .upload-icon svg { width: 16px; height: 16px; stroke: var(--muted); }
        .upload-title { font-size: 12px; font-weight: 500; color: var(--ink); margin-bottom: 2px; }
        .upload-sub { font-size: 11px; color: var(--muted); }
        .upload-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: #f0fdf4; color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 2px 8px; border-radius: 100px;
            font-size: 10px; font-weight: 500; margin-top: 6px;
        }

        /* ── FORM ACTIONS ── */
        .form-actions {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            background: var(--cream);
        }

        .btn-cancel {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 9px 18px; background: none;
            border: 1px solid var(--border); border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            color: var(--muted); text-decoration: none; transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: var(--ink); color: var(--ink); }

        .btn-submit {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 22px;
            background: var(--accent); color: white;
            border: none; border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(200,98,42,0.25);
        }
        .btn-submit:hover { background: #b05520; box-shadow: 0 6px 20px rgba(200,98,42,0.35); }
        .btn-submit svg { width: 14px; height: 14px; }

        /* ── ERROR BOX ── */
        .error-box {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fef2f2; border: 1px solid #fecaca;
            border-left: 3px solid #dc2626; color: #dc2626;
            padding: 12px 16px; border-radius: 10px;
            font-size: 13px; margin-bottom: 16px;
        }
        .error-box svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
        .error-box ul { list-style: disc; padding-left: 16px; }
        .error-box li { margin-bottom: 2px; }

        /* ── PREVIEW CARD ── */
        .preview-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
            position: sticky;
            top: 100px;
        }

        .preview-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: white;
            display: flex; align-items: center; justify-content: space-between;
        }
        .preview-card-title {
            font-size: 11px; font-weight: 500; color: var(--muted);
            text-transform: uppercase; letter-spacing: 0.8px;
        }
        .preview-live-dot {
            display: flex; align-items: center; gap: 5px;
            font-size: 10px; color: #16a34a;
        }
        .preview-live-dot::before {
            content: '';
            width: 6px; height: 6px;
            background: #16a34a; border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .preview-book {
            padding: 24px 20px;
            display: flex; flex-direction: column; align-items: center; gap: 14px;
        }

        .preview-cover {
            width: 100px; height: 136px;
            border-radius: 8px;
            background: linear-gradient(135deg, #e8e0d4 0%, #d4c8b8 100%);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            box-shadow: 4px 6px 20px rgba(13,13,13,0.12);
            flex-shrink: 0;
        }
        .preview-cover svg { width: 32px; height: 32px; stroke: var(--muted); opacity: 0.4; }
        .preview-cover img { width: 100%; height: 100%; object-fit: cover; }

        .preview-info { text-align: center; width: 100%; }
        .preview-title {
            font-family: 'Playfair Display', serif;
            font-size: 14px; font-weight: 700; color: var(--ink);
            line-height: 1.3; margin-bottom: 3px;
        }
        .preview-author { font-size: 12px; color: var(--muted); margin-bottom: 14px; }

        .preview-meta {
            width: 100%; border-top: 1px solid var(--border);
            padding-top: 12px; display: flex; flex-direction: column; gap: 8px;
        }
        .preview-meta-row { display: flex; justify-content: space-between; align-items: center; }
        .preview-meta-key { font-size: 11px; color: var(--muted); }
        .preview-meta-val { font-size: 12px; font-weight: 500; color: var(--ink); }

        /* Stok badge */
        .stok-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 8px; border-radius: 100px;
            font-size: 11px; font-weight: 500;
        }
        .stok-badge::before {
            content: ''; width: 5px; height: 5px;
            border-radius: 50%; background: currentColor; opacity: 0.6;
        }
        .stok-green  { background: #f0fdf4; color: #15803d; }
        .stok-yellow { background: #fefce8; color: #a16207; }
        .stok-red    { background: #fef2f2; color: #dc2626; }

        /* ── INFO CARD ── */
        .info-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
            margin-top: 16px;
        }

        .info-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: white;
            font-size: 11px; font-weight: 500; color: var(--muted);
            text-transform: uppercase; letter-spacing: 0.8px;
        }

        .info-card-body { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }

        .info-row { display: flex; align-items: center; gap: 10px; }

        .info-icon {
            width: 28px; height: 28px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 6px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .info-icon svg { width: 13px; height: 13px; stroke: var(--muted); }

        .info-text { font-size: 12px; color: var(--muted); line-height: 1.4; }
        .info-text strong { color: var(--ink); font-weight: 500; }

        /* Divider */
        .section-divider {
            height: 1px; background: var(--border); margin: 4px 0;
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
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-section">Manajemen Buku</div>

        <a href="{{ route('admin.buku.index') }}" class="sidebar-link active">
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
            <div class="topbar-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </div>
            <div>
                <div class="topbar-title">Edit Buku</div>
                <div class="topbar-sub">Perbarui data — <strong style="color:var(--ink);">{{ $buku->judul }}</strong></div>
            </div>
        </div>
        <div class="topbar-actions">
            <a href="{{ route('admin.buku.index') }}" class="btn-back">← Kembali</a>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('admin.buku.index') }}">Daftar Buku</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Edit: {{ Str::limit($buku->judul, 40) }}</span>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- KOLOM KIRI: FORM -->
        <div>

            @if($errors->any())
            <div class="error-box">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')

                <!-- Card: Informasi Buku -->
                <div class="form-card" style="margin-bottom: 16px;">
                    <div class="form-card-header">
                        <div class="form-card-header-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="form-card-title">Informasi Buku</div>
                            <div class="form-card-subtitle">Ubah data utama identitas buku</div>
                        </div>
                    </div>
                    <div class="form-body">

                        <div class="form-group">
                            <label class="field-label">
                                Judul Buku <span class="required-dot"></span>
                            </label>
                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                class="field-input @error('judul') is-error @enderror"
                                value="{{ old('judul', $buku->judul) }}"
                                required>
                            @error('judul')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="field-label">
                                Pengarang <span class="required-dot"></span>
                            </label>
                            <input
                                type="text"
                                id="pengarang"
                                name="pengarang"
                                class="field-input @error('pengarang') is-error @enderror"
                                value="{{ old('pengarang', $buku->pengarang) }}"
                                required>
                            @error('pengarang')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="field-label">
                                Penerbit <span class="required-dot"></span>
                            </label>
                            <input
                                type="text"
                                id="penerbit"
                                name="penerbit"
                                class="field-input @error('penerbit') is-error @enderror"
                                value="{{ old('penerbit', $buku->penerbit) }}"
                                required>
                            @error('penerbit')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div>
                                <label class="field-label">
                                    Tahun Terbit <span class="required-dot"></span>
                                </label>
                                <input
                                    type="number"
                                    id="tahun_terbit"
                                    name="tahun_terbit"
                                    class="field-input @error('tahun_terbit') is-error @enderror"
                                    value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                                    min="1900" max="2099"
                                    required>
                                @error('tahun_terbit')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="field-label">
                                    Stok <span class="required-dot"></span>
                                </label>
                                <input
                                    type="number"
                                    id="stok"
                                    name="stok"
                                    class="field-input @error('stok') is-error @enderror"
                                    value="{{ old('stok', $buku->stok) }}"
                                    min="0"
                                    required>
                                @error('stok')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Card: Cover Buku -->
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <div class="form-card-title">Cover Buku</div>
                            <div class="form-card-subtitle">Biarkan kosong jika tidak ingin mengubah cover</div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="cover-section">

                            <!-- Cover saat ini -->
                            <div class="current-cover">
                                @if($buku->image)
                                    <img src="{{ asset('storage/' . $buku->image) }}"
                                         class="current-cover-img"
                                         id="currentCoverImg"
                                         alt="Cover saat ini">
                                @else
                                    <div class="current-cover-placeholder" id="currentCoverPlaceholder">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    </div>
                                @endif
                                <span class="cover-badge">Saat ini</span>
                            </div>

                            <!-- Upload baru -->
                            <div class="cover-upload-wrap">
                                <div class="upload-zone" id="uploadZone">
                                    <input type="file" name="image" id="imageInput" accept="image/*">
                                    <div id="uploadDefault">
                                        <div class="upload-icon">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        </div>
                                        <div class="upload-title">Unggah cover baru</div>
                                        <div class="upload-sub">PNG, JPG, WEBP — maks. 2MB</div>
                                    </div>
                                    <div id="uploadSuccess" style="display:none;">
                                        <div class="upload-icon" style="background:#f0fdf4; border-color:#bbf7d0;">
                                            <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div class="upload-title" style="color:#15803d;">Siap diganti</div>
                                        <span class="upload-badge" id="fileName">—</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.buku.index') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Update Buku
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- KOLOM KANAN: PREVIEW & INFO -->
        <div>

            <!-- Preview Card -->
            <div class="preview-card">
                <div class="preview-card-header">
                    <div class="preview-card-title">Pratinjau</div>
                    <div class="preview-live-dot">Live</div>
                </div>
                <div class="preview-book">
                    <div class="preview-cover" id="previewCover">
                        @if($buku->image)
                            <img src="{{ asset('storage/' . $buku->image) }}" alt="Cover">
                        @else
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        @endif
                    </div>
                    <div class="preview-info">
                        <div class="preview-title" id="previewJudul">{{ $buku->judul }}</div>
                        <div class="preview-author" id="previewPengarang">{{ $buku->pengarang }}</div>
                        <div class="preview-meta">
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Penerbit</span>
                                <span class="preview-meta-val" id="previewPenerbit">{{ $buku->penerbit }}</span>
                            </div>
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Tahun</span>
                                <span class="preview-meta-val" id="previewTahun">{{ $buku->tahun_terbit }}</span>
                            </div>
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Stok</span>
                                <span id="previewStok">
                                    @php $stok = $buku->stok; @endphp
                                    @if($stok > 5)
                                        <span class="stok-badge stok-green">{{ $stok }} Tersedia</span>
                                    @elseif($stok > 0)
                                        <span class="stok-badge stok-yellow">{{ $stok }} Hampir Habis</span>
                                    @else
                                        <span class="stok-badge stok-red">Habis</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="info-card">
                <div class="info-card-header">Informasi Data</div>
                <div class="info-card-body">
                    <div class="info-row">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                        </div>
                        <div class="info-text">ID Buku: <strong>#{{ $buku->id }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="info-text">Ditambahkan: <strong>{{ $buku->created_at ? $buku->created_at->format('d M Y') : '—' }}</strong></div>
                    </div>
                    <div class="info-row">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="info-text">Terakhir diubah: <strong>{{ $buku->updated_at ? $buku->updated_at->diffForHumans() : '—' }}</strong></div>
                    </div>
                    <div class="section-divider"></div>
                    <div class="info-row">
                        <div class="info-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="info-text">Cover tidak wajib diisi ulang saat update.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    /* Sidebar active link */
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });

    /* Live preview — teks */
    function syncPreview(inputId, targetId, fallback) {
        const el = document.getElementById(inputId);
        const target = document.getElementById(targetId);
        if (!el || !target) return;
        el.addEventListener('input', () => {
            target.textContent = el.value.trim() || fallback;
        });
    }

    syncPreview('judul',        'previewJudul',     'Judul Buku');
    syncPreview('pengarang',    'previewPengarang', 'Nama Pengarang');
    syncPreview('penerbit',     'previewPenerbit',  '—');
    syncPreview('tahun_terbit', 'previewTahun',     '—');

    /* Live preview — stok + badge warna */
    const stokInput = document.getElementById('stok');
    const previewStok = document.getElementById('previewStok');

    function updateStokBadge(val) {
        const n = parseInt(val);
        let cls, label;
        if (isNaN(n))      { cls = 'stok-red';    label = 'Habis'; }
        else if (n > 5)    { cls = 'stok-green';  label = `${n} Tersedia`; }
        else if (n > 0)    { cls = 'stok-yellow'; label = `${n} Hampir Habis`; }
        else               { cls = 'stok-red';    label = 'Habis'; }
        previewStok.innerHTML = `<span class="stok-badge ${cls}">${label}</span>`;
    }

    if (stokInput) {
        stokInput.addEventListener('input', () => updateStokBadge(stokInput.value));
    }

    /* Cover upload preview */
    const imageInput   = document.getElementById('imageInput');
    const uploadZone   = document.getElementById('uploadZone');
    const uploadDefault = document.getElementById('uploadDefault');
    const uploadSuccess = document.getElementById('uploadSuccess');
    const fileNameEl   = document.getElementById('fileName');
    const previewCover = document.getElementById('previewCover');
    const currentImg   = document.getElementById('currentCoverImg');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            /* Upload zone feedback */
            uploadZone.classList.add('has-file');
            uploadDefault.style.display = 'none';
            uploadSuccess.style.display = 'block';
            fileNameEl.textContent = file.name.length > 22
                ? file.name.substring(0, 20) + '…'
                : file.name;

            /* Update preview cover & current cover */
            const reader = new FileReader();
            reader.onload = (e) => {
                previewCover.innerHTML = `<img src="${e.target.result}" alt="Cover baru" style="width:100%;height:100%;object-fit:cover;">`;
                if (currentImg) {
                    currentImg.src = e.target.result;
                }
            };
            reader.readAsDataURL(file);
        });
    }
</script>

</body>
</html>