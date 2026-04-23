<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku — Perpustakaan Digital</title>
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

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: none; border: 1px solid var(--border);
            border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500; color: var(--muted);
            text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        /* ── CONTENT ── */
        .content {
            padding: 28px 36px; flex: 1;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            align-items: start;
            max-width: 960px;
        }

        /* ── ALERT ── */
        .alert-error {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fef2f2; border: 1px solid #fecaca; border-left: 3px solid #dc2626;
            color: #dc2626; padding: 12px 16px; border-radius: 10px;
            font-size: 13px; margin-bottom: 16px;
        }
        .alert-error svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }

        /* ── FORM CARD ── */
        .form-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
        }

        .form-card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--border);
            background: white; display: flex; align-items: center; gap: 10px;
        }
        .form-card-header-icon {
            width: 32px; height: 32px; background: var(--cream); border: 1px solid var(--border);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
        }
        .form-card-header-icon svg { width: 15px; height: 15px; stroke: var(--muted); }
        .form-card-title { font-size: 13px; font-weight: 500; color: var(--ink); }
        .form-card-subtitle { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .form-body { padding: 22px 24px; }

        /* ── BOOK SELECT LIST ── */
        .book-select-list {
            display: flex; flex-direction: column; gap: 8px;
            max-height: 420px; overflow-y: auto;
            padding-right: 4px;
        }

        .book-select-list::-webkit-scrollbar { width: 4px; }
        .book-select-list::-webkit-scrollbar-track { background: transparent; }
        .book-select-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

        .book-option {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 14px; background: var(--cream);
            border: 1.5px solid var(--border); border-radius: 12px;
            cursor: pointer; transition: all 0.18s;
            position: relative;
        }
        .book-option:hover:not(.disabled) { background: white; border-color: rgba(13,13,13,0.18); }
        .book-option.selected { border-color: var(--accent); background: rgba(200,98,42,0.04); }
        .book-option.disabled { opacity: 0.45; cursor: not-allowed; }

        .book-option input[type="radio"] { display: none; }

        .book-option-cover {
            width: 44px; height: 60px; border-radius: 6px; flex-shrink: 0;
            overflow: hidden; border: 1px solid var(--border);
            background: linear-gradient(135deg, #e8e0d4, #d0c4b4);
            position: relative;
        }
        .book-option-cover img { width: 100%; height: 100%; object-fit: cover; }
        .book-option-cover-placeholder {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
        }
        .book-option-cover-placeholder svg { width: 18px; height: 18px; stroke: rgba(255,255,255,0.5); }

        .book-option-info { flex: 1; min-width: 0; }
        .book-option-title { font-size: 13px; font-weight: 500; color: var(--ink); line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .book-option-author { font-size: 11px; color: var(--muted); margin-top: 2px; }
        .book-option-pub { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .book-option-stok {
            display: flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 500; flex-shrink: 0;
        }
        .stok-dot { width: 6px; height: 6px; border-radius: 50%; }

        /* Selected checkmark */
        .option-check {
            width: 20px; height: 20px; border-radius: 50%;
            border: 1.5px solid var(--border); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.18s;
        }
        .option-check svg { width: 10px; height: 10px; stroke: white; opacity: 0; transition: opacity 0.18s; }
        .book-option.selected .option-check { background: var(--accent); border-color: var(--accent); }
        .book-option.selected .option-check svg { opacity: 1; }

        /* Search within books */
        .book-search-wrap {
            position: relative; margin-bottom: 12px;
        }
        .book-search-wrap svg {
            position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
            width: 14px; height: 14px; stroke: var(--muted); pointer-events: none;
        }
        .book-search-input {
            width: 100%; padding: 9px 12px 9px 34px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 9px; font-family: 'DM Sans', sans-serif;
            font-size: 12px; color: var(--ink); outline: none; transition: all 0.18s;
        }
        .book-search-input::placeholder { color: rgba(138,128,112,0.5); }
        .book-search-input:focus { border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(200,98,42,0.07); }

        /* Color palettes */
        .bc-1 { background: linear-gradient(135deg, #3b4a6b, #2a3555); }
        .bc-2 { background: linear-gradient(135deg, #c8622a, #a04d1f); }
        .bc-3 { background: linear-gradient(135deg, #5a6e4a, #3d4f31); }
        .bc-4 { background: linear-gradient(135deg, #8a6a3a, #6b4f28); }
        .bc-5 { background: linear-gradient(135deg, #4a5a7a, #364470); }
        .bc-6 { background: linear-gradient(135deg, #7a4a6a, #5e3450); }
        .bc-7 { background: linear-gradient(135deg, #4a7a6a, #346050); }
        .bc-8 { background: linear-gradient(135deg, #6a4a3a, #4e342a); }

        /* ── FORM ACTIONS ── */
        .form-actions {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 24px; border-top: 1px solid var(--border);
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
            padding: 10px 24px; background: var(--ink); color: white;
            border: none; border-radius: 100px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s;
        }
        .btn-submit:hover { background: var(--accent); box-shadow: 0 6px 20px rgba(200,98,42,0.28); }
        .btn-submit:disabled { background: var(--muted); cursor: not-allowed; box-shadow: none; }
        .btn-submit svg { width: 14px; height: 14px; }

        /* ── PREVIEW CARD ── */
        .preview-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
            position: sticky; top: 100px;
        }

        .preview-header {
            padding: 14px 20px; border-bottom: 1px solid var(--border);
            background: white; display: flex; align-items: center; justify-content: space-between;
        }
        .preview-header-title { font-size: 11px; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; }
        .preview-live {
            display: flex; align-items: center; gap: 5px;
            font-size: 10px; color: #16a34a;
        }
        .preview-live::before {
            content: ''; width: 6px; height: 6px; background: #16a34a; border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:0.4; } }

        .preview-body { padding: 24px 20px; display: flex; flex-direction: column; align-items: center; gap: 16px; }

        .preview-cover {
            width: 110px; height: 150px; border-radius: 10px;
            overflow: hidden; border: 1px solid var(--border);
            box-shadow: 4px 6px 20px rgba(13,13,13,0.14);
            background: linear-gradient(135deg, #e8e0d4, #d0c4b4);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s;
        }
        .preview-cover img { width: 100%; height: 100%; object-fit: cover; }
        .preview-cover-placeholder {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            width: 100%; height: 100%; padding: 12px; text-align: center;
        }
        .preview-cover-placeholder svg { width: 28px; height: 28px; stroke: var(--muted); opacity: 0.4; margin-bottom: 6px; }
        .preview-cover-placeholder span { font-size: 10px; color: var(--muted); }

        .preview-info { width: 100%; text-align: center; }
        .preview-title { font-family: 'Playfair Display', serif; font-size: 14px; font-weight: 700; color: var(--ink); line-height: 1.3; margin-bottom: 4px; }
        .preview-author { font-size: 12px; color: var(--muted); margin-bottom: 14px; }

        .preview-meta { width: 100%; border-top: 1px solid var(--border); padding-top: 14px; display: flex; flex-direction: column; gap: 8px; }
        .preview-meta-row { display: flex; justify-content: space-between; align-items: center; }
        .preview-meta-key { font-size: 11px; color: var(--muted); }
        .preview-meta-val { font-size: 12px; font-weight: 500; color: var(--ink); }
        .preview-stok-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 100px; font-size: 11px; font-weight: 500;
        }
        .preview-stok-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: 0.6; }
        .badge-green  { background: #f0fdf4; color: #15803d; }
        .badge-yellow { background: #fefce8; color: #a16207; }
        .badge-red    { background: #fef2f2; color: #dc2626; }

        /* ── INFO CARD ── */
        .info-card {
            background: var(--paper); border: 1px solid var(--border);
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
            margin-top: 16px;
        }
        .info-header {
            padding: 14px 20px; border-bottom: 1px solid var(--border);
            background: white; font-size: 11px; font-weight: 500; color: var(--muted);
            text-transform: uppercase; letter-spacing: 0.8px;
        }
        .info-body { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }
        .info-item { display: flex; align-items: flex-start; gap: 9px; }
        .info-dot { width: 6px; height: 6px; border-radius: 50%; margin-top: 4px; flex-shrink: 0; }
        .info-text { font-size: 12px; color: var(--muted); line-height: 1.5; }
        .info-text strong { color: var(--ink); font-weight: 500; }

        /* No selection state */
        .preview-empty { opacity: 0.5; }

        /* Hidden select for form submission */
        #buku_id { display: none; }
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
       <a href="{{ route('user.cari') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Buku
        </a>

        <div class="nav-section">Peminjaman</div>

        <a href="{{ route('transaksi.index') }}" class="nav-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            Riwayat Peminjaman
        </a>
        <a href="{{ route('transaksi.create') }}" class="nav-link active">
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
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <div>
                <div class="topbar-title">Pinjam Buku</div>
                <div class="topbar-sub">Pilih buku yang ingin dipinjam</div>
            </div>
        </div>
        <a href="{{ route('transaksi.index') }}" class="btn-back">← Kembali</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- KOLOM KIRI: FORM -->
        <div>

            @if(session('error'))
            <div class="alert-error">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('transaksi.store') }}" method="POST" id="pinjamForm">
                @csrf
                <input type="hidden" name="buku_id" id="buku_id" value="">

                <!-- Card: Pilih Buku -->
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <div class="form-card-title">Pilih Buku</div>
                            <div class="form-card-subtitle">Klik buku yang ingin kamu pinjam</div>
                        </div>
                    </div>
                    <div class="form-body">
                   

                        <!-- Search filter -->
                        <div class="book-search-wrap">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" id="filterInput" class="book-search-input" placeholder="Filter buku di sini…">
                        </div>

                        <div class="book-select-list" id="bookList">
                            @foreach($buku as $i => $item)
                            @php
                                $colors = ['bc-1','bc-2','bc-3','bc-4','bc-5','bc-6','bc-7','bc-8'];
                                $color  = $colors[$i % count($colors)];
                                $habis  = $item->stok == 0;
                            @endphp
                            <label class="book-option {{ $habis ? 'disabled' : '' }}"
                                   data-id="{{ $item->id }}"
                                   data-judul="{{ $item->judul }}"
                                   data-pengarang="{{ $item->pengarang }}"
                                   data-penerbit="{{ $item->penerbit }}"
                                   data-tahun="{{ $item->tahun_terbit }}"
                                   data-stok="{{ $item->stok }}"
                                   data-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}"
                                   data-color="{{ $color }}"
                                   onclick="{{ $habis ? 'return false;' : '' }}"
                                   style="animation-delay: {{ $loop->index * 0.03 }}s">
                                <input type="radio" name="_buku_display" value="{{ $item->id }}" {{ $habis ? 'disabled' : '' }}>

                                <!-- Cover mini -->
                                <div class="book-option-cover {{ !$item->image ? $color : '' }}">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->judul }}">
                                    @else
                                        <div class="book-option-cover-placeholder">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="book-option-info">
                                    <div class="book-option-title">{{ $item->judul }}</div>
                                    <div class="book-option-author">{{ $item->pengarang }}</div>
                                    <div class="book-option-pub">{{ $item->penerbit }} · {{ $item->tahun_terbit }}</div>
                                </div>

                                <!-- Stok -->
                                <div class="book-option-stok">
                                    <div class="stok-dot" style="background: {{ $item->stok > 5 ? '#16a34a' : ($item->stok > 0 ? '#d97706' : '#dc2626') }};"></div>
                                    <span style="color: {{ $item->stok > 5 ? '#16a34a' : ($item->stok > 0 ? '#d97706' : '#dc2626') }};">
                                        {{ $habis ? 'Habis' : $item->stok }}
                                    </span>
                                </div>
                                
                                <!-- Checkmark -->
                                <div class="option-check">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </label>
                            @endforeach
                        </div>
     <div style="margin-top:16px;">
    <label style="font-size:12px; font-weight:500;">Tanggal Kembali</label>
<input 
    type="date" 
    name="tanggal_kembali_rencana"
    min="{{ date('Y-m-d') }}"
    max="{{ date('Y-m-d', strtotime('+7 days')) }}"
    required
    style="width:100%; padding:10px;"
>
</div>
                        @if($buku->isEmpty())
                        <div style="text-align:center; padding:32px 20px; color:var(--muted); font-size:13px;">
                            Belum ada buku tersedia untuk dipinjam.
                        </div>
                        @endif

                    </div>

                    <div class="form-actions">
                        <a href="{{ route('transaksi.index') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit" id="btnSubmit" disabled>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            Pinjam Sekarang
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- KOLOM KANAN: PREVIEW + INFO -->
        <div>

            <!-- Preview Card -->
            <div class="preview-card">
                <div class="preview-header">
                    <span class="preview-header-title">Pratinjau Buku</span>
                    <span class="preview-live">Live</span>
                </div>
                <div class="preview-body">
                    <div class="preview-cover preview-empty" id="previewCover">
                        <div class="preview-cover-placeholder" id="previewPlaceholder">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <span>Pilih buku</span>
                        </div>
                    </div>
                    <div class="preview-info">
                        <div class="preview-title" id="previewTitle">—</div>
                        <div class="preview-author" id="previewAuthor">—</div>
                        <div class="preview-meta">
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Penerbit</span>
                                <span class="preview-meta-val" id="previewPenerbit">—</span>
                            </div>
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Tahun</span>
                                <span class="preview-meta-val" id="previewTahun">—</span>
                            </div>
                            <div class="preview-meta-row">
                                <span class="preview-meta-key">Stok</span>
                                <span id="previewStok">—</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="info-card">
                <div class="info-header">Ketentuan Peminjaman</div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-dot" style="background:#3b82f6;"></div>
                        <div class="info-text">Durasi peminjaman <strong>7 hari</strong> sejak tanggal pinjam.</div>
                    </div>
                    <div class="info-item">
                        <div class="info-dot" style="background:#22c55e;"></div>
                        <div class="info-text">Maksimal <strong>3 buku</strong> dipinjam bersamaan.</div>
                    </div>
                    <div class="info-item">
                        <div class="info-dot" style="background:var(--accent);"></div>
                        <div class="info-text">Keterlambatan dikenakan <strong>denda per hari</strong>.</div>
                    </div>
                    <div class="info-item">
                        <div class="info-dot" style="background:#a855f7;"></div>
                        <div class="info-text">Buku habis stok <strong>tidak dapat dipinjam</strong> saat ini.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    /* Sidebar active */
    const path = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === path) {
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });

    /* Book selection */
    const options    = document.querySelectorAll('.book-option:not(.disabled)');
    const bukuInput  = document.getElementById('buku_id');
    const btnSubmit  = document.getElementById('btnSubmit');
    const previewCover    = document.getElementById('previewCover');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const previewTitle   = document.getElementById('previewTitle');
    const previewAuthor  = document.getElementById('previewAuthor');
    const previewPenerbit = document.getElementById('previewPenerbit');
    const previewTahun   = document.getElementById('previewTahun');
    const previewStok    = document.getElementById('previewStok');

    function updatePreview(el) {
        const d = el.dataset;
        previewTitle.textContent   = d.judul;
        previewAuthor.textContent  = d.pengarang;
        previewPenerbit.textContent = d.penerbit;
        previewTahun.textContent   = d.tahun;

        /* Stok badge */
        const stok = parseInt(d.stok);
        let cls = 'badge-green', label = stok + ' Tersedia';
        if (stok === 0)    { cls = 'badge-red';    label = 'Habis'; }
        else if (stok <= 5){ cls = 'badge-yellow';  label = stok + ' Hampir Habis'; }
        previewStok.innerHTML = `<span class="preview-stok-badge ${cls}">${label}</span>`;

        /* Cover */
        previewCover.classList.remove('preview-empty');
        if (d.image) {
            previewCover.innerHTML = `<img src="${d.image}" alt="${d.judul}" style="width:100%;height:100%;object-fit:cover;">`;
        } else {
            const color = d.color || 'bc-1';
            previewCover.innerHTML = `
                <div class="preview-cover-placeholder ${color}" style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:12px;text-align:center;">
                    <div style="font-family:'Playfair Display',serif;font-size:11px;font-weight:700;color:rgba(255,255,255,0.9);line-height:1.3;">${d.judul.substring(0,30)}</div>
                    <div style="font-size:9px;color:rgba(255,255,255,0.6);margin-top:4px;">${d.pengarang.substring(0,20)}</div>
                </div>`;
            previewCover.style.position = 'relative';
        }
    }

    options.forEach(opt => {
        opt.addEventListener('click', () => {
            /* Deselect all */
            document.querySelectorAll('.book-option').forEach(o => o.classList.remove('selected'));
            /* Select clicked */
            opt.classList.add('selected');
            opt.querySelector('input[type="radio"]').checked = true;
            bukuInput.value = opt.dataset.id;
            btnSubmit.disabled = false;
            updatePreview(opt);
        });
    });

    /* Filter books */
    document.getElementById('filterInput').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.book-option').forEach(opt => {
            const text = (opt.dataset.judul + ' ' + opt.dataset.pengarang + ' ' + opt.dataset.penerbit).toLowerCase();
            opt.style.display = text.includes(q) ? 'flex' : 'none';
        });
    });

    /* Form validation */
    document.getElementById('pinjamForm').addEventListener('submit', function (e) {
        if (!bukuInput.value) {
            e.preventDefault();
            alert('Silakan pilih buku terlebih dahulu.');
        }
    });
</script>

</body>
</html>