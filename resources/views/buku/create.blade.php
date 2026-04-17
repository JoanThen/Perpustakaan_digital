<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku — Perpustakaan Digital</title>
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
            width: 40px; height: 40px; background: var(--ink);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
        }
        .topbar-icon svg { width: 18px; height: 18px; stroke: white; }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 900; letter-spacing: -0.6px; line-height: 1.1;
        }
        .topbar-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; background: none;
            border: 1px solid var(--border); border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
            color: var(--muted); text-decoration: none; transition: all 0.2s;
        }
        .btn-back:hover { border-color: var(--ink); color: var(--ink); }

        /* ── CONTENT ── */
        .content {
            padding: 36px;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
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
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            background: white;
            display: flex; align-items: center; gap: 10px;
        }

        .form-card-header-icon {
            width: 32px; height: 32px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .form-card-header-icon svg { width: 15px; height: 15px; stroke: var(--muted); }

        .form-card-title { font-size: 13px; font-weight: 500; color: var(--ink); }
        .form-card-subtitle { font-size: 11px; color: var(--muted); margin-top: 1px; }

        .form-body { padding: 24px; }

        /* ── FORM ELEMENTS ── */
        .form-group { margin-bottom: 18px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 18px; }

        .field-label {
            display: flex; align-items: center; gap: 5px;
            font-size: 11px; font-weight: 500;
            letter-spacing: 0.8px; text-transform: uppercase;
            color: var(--muted); margin-bottom: 7px;
        }

        .required-dot {
            width: 5px; height: 5px;
            background: var(--accent);
            border-radius: 50%;
            display: inline-block;
        }

        .field-input {
            width: 100%;
            padding: 11px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; color: var(--ink);
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            transition: all 0.2s;
        }
        .field-input::placeholder { color: rgba(138,128,112,0.5); }
        .field-input:focus {
            border-color: var(--accent);
            background: white;
            box-shadow: 0 0 0 3px rgba(200,98,42,0.08);
        }
        .field-input.is-error { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,0.08); }

        .field-hint { font-size: 11px; color: var(--muted); margin-top: 5px; }
        .field-error { font-size: 11px; color: #dc2626; margin-top: 5px; }

        /* ── UPLOAD COVER ── */
        .upload-zone {
            border: 1.5px dashed var(--border);
            border-radius: 12px;
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: var(--cream);
        }
        .upload-zone:hover { border-color: var(--accent); background: rgba(200,98,42,0.03); }
        .upload-zone.has-file { border-color: #16a34a; background: #f0fdf4; }
        .upload-zone input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .upload-icon {
            width: 44px; height: 44px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px;
        }
        .upload-icon svg { width: 20px; height: 20px; stroke: var(--muted); }
        .upload-title { font-size: 13px; font-weight: 500; color: var(--ink); margin-bottom: 3px; }
        .upload-sub { font-size: 11px; color: var(--muted); }
        .upload-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: #f0fdf4; color: #15803d;
            border: 1px solid #bbf7d0;
            padding: 3px 10px; border-radius: 100px;
            font-size: 11px; font-weight: 500;
            margin-top: 8px;
        }

        /* ── PREVIEW CARD (sidebar kanan) ── */
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
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: white;
        }
        .preview-card-title { font-size: 12px; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; }

        .preview-book {
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .preview-cover {
            width: 110px; height: 150px;
            border-radius: 8px;
            background: linear-gradient(135deg, #e8e0d4 0%, #d4c8b8 100%);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
            box-shadow: 4px 6px 20px rgba(13,13,13,0.12);
            flex-shrink: 0;
        }
        .preview-cover svg { width: 36px; height: 36px; stroke: var(--muted); opacity: 0.4; }
        .preview-cover img { width: 100%; height: 100%; object-fit: cover; }

        .preview-info { text-align: center; width: 100%; }
        .preview-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px; font-weight: 700; color: var(--ink);
            line-height: 1.3; margin-bottom: 4px;
        }
        .preview-author { font-size: 12px; color: var(--muted); margin-bottom: 14px; }

        .preview-meta {
            width: 100%;
            border-top: 1px solid var(--border);
            padding-top: 14px;
            display: flex; flex-direction: column; gap: 8px;
        }
        .preview-meta-row { display: flex; justify-content: space-between; align-items: center; }
        .preview-meta-key { font-size: 11px; color: var(--muted); }
        .preview-meta-val { font-size: 12px; font-weight: 500; color: var(--ink); }

        /* ── ERROR BOX ── */
        .error-box {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 3px solid #dc2626;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .error-box svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
        .error-box ul { list-style: disc; padding-left: 16px; }
        .error-box li { margin-bottom: 2px; }

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
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            color: var(--muted); text-decoration: none; transition: all 0.2s;
        }
        .btn-cancel:hover { border-color: var(--ink); color: var(--ink); }

        .btn-submit {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 9px 24px;
            background: var(--ink); color: var(--cream);
            border: none; border-radius: 100px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-submit:hover { background: var(--accent); box-shadow: 0 6px 20px rgba(200,98,42,0.28); }
        .btn-submit svg { width: 14px; height: 14px; }

        /* ── TIPS CARD ── */
        .tips-card {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.04);
            margin-top: 16px;
        }
        .tips-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: white;
            font-size: 11px; font-weight: 500; color: var(--muted);
            text-transform: uppercase; letter-spacing: 0.8px;
        }
        .tips-body { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }
        .tip-item { display: flex; align-items: flex-start; gap: 8px; }
        .tip-dot {
            width: 5px; height: 5px; background: var(--accent);
            border-radius: 50%; margin-top: 5px; flex-shrink: 0;
        }
        .tip-text { font-size: 12px; color: var(--muted); line-height: 1.5; }
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

        <a href="{{ route('admin.buku.index') }}" class="sidebar-link">
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
        <a href="{{ route('admin.buku.create') }}" class="sidebar-link active">
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
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </div>
            <div>
                <div class="topbar-title">Tambah Buku</div>
                <div class="topbar-sub">Masukkan data buku baru ke sistem</div>
            </div>
        </div>
        <a href="{{ route('admin.buku.index') }}" class="btn-back">← Kembali</a>
    </div>

    <!-- CONTENT -->
   
</div>
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

            <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data" id="bukuForm">
                @csrf

                <!-- Card: Informasi Buku -->
                <div class="form-card" style="margin-bottom: 16px;">
                    <div class="form-card-header">
                        <div class="form-card-header-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <div class="form-card-title">Informasi Buku</div>
                            <div class="form-card-subtitle">Data utama identitas buku</div>
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
                                value="{{ old('judul') }}"
                                placeholder="Contoh: Laskar Pelangi"
                                required>
                            @error('judul')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                            <div style="margin-bottom:15px;">
    <label>Kategori</label>
  <select name="kategori_id">
    @foreach(\App\Models\Kategori::all() as $k)
        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
    @endforeach
</select>
</div>
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
                                value="{{ old('pengarang') }}"
                                placeholder="Contoh: Andrea Hirata"
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
                                value="{{ old('penerbit') }}"
                                placeholder="Contoh: Bentang Pustaka"
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
                                    value="{{ old('tahun_terbit') }}"
                                    placeholder="Contoh: 2005"
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
                                    value="{{ old('stok') }}"
                                    placeholder="Contoh: 10"
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
                            <div class="form-card-subtitle">Unggah gambar sampul buku (opsional)</div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="image" id="imageInput" accept="image/*">
                            <div id="uploadDefault">
                                <div class="upload-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                </div>
                                <div class="upload-title">Klik untuk unggah cover</div>
                                <div class="upload-sub">PNG, JPG, WEBP — maks. 2MB</div>
                            </div>
                            <div id="uploadSuccess" style="display:none;">
                                <div class="upload-icon" style="background:#f0fdf4; border-color:#bbf7d0;">
                                    <svg fill="none" stroke="#16a34a" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="upload-title" style="color:#15803d;">File dipilih</div>
                                <span class="upload-badge" id="fileName">—</span>
                            </div>
                        </div>
                        <div class="field-hint" style="margin-top:8px;">Gambar akan ditampilkan sebagai sampul buku di halaman daftar.</div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.buku.index') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Buku
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- KOLOM KANAN: PREVIEW & TIPS -->
        <div>
            <!-- Preview Card -->
            <div class="preview-card">
                <div class="preview-card-header">
                    <div class="preview-card-title">Pratinjau Buku</div>
                </div>
                <div class="preview-book">
                    <div class="preview-cover" id="previewCover">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="preview-info">
                        <div class="preview-title" id="previewJudul">Judul Buku</div>
                        <div class="preview-author" id="previewPengarang">Nama Pengarang</div>
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
                                <span class="preview-meta-val" id="previewStok">—</span>
                            </div>
                            <div class="form-group">
    <label class="field-label">
        Kategori <span class="required-dot"></span>
    </label>

    <select name="kategori_id"
        class="field-input @error('kategori_id') is-error @enderror"
        required>
        
        <option value="">-- Pilih Kategori --</option>

        @foreach($kategori as $k)
            <option value="{{ $k->id }}"
                {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                {{ $k->nama_kategori }}
            </option>
        @endforeach

    </select>

    @error('kategori_id')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="tips-card">
                <div class="tips-header">Tips Pengisian</div>
                <div class="tips-body">
                    <div class="tip-item">
                        <div class="tip-dot"></div>
                        <div class="tip-text">Judul dan pengarang ditulis sesuai yang tertera di sampul buku.</div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-dot"></div>
                        <div class="tip-text">Gunakan tahun terbit edisi yang sedang tersedia di perpustakaan.</div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-dot"></div>
                        <div class="tip-text">Cover idealnya berukuran 3:4 agar tampil proporsional di daftar buku.</div>
                    </div>
                    <div class="tip-item">
                        <div class="tip-dot"></div>
                        <div class="tip-text">Isi stok sesuai jumlah fisik buku yang tersedia saat ini.</div>
                    </div>
                </div>
            </div>
        </div>
 <div class="form-card" style="margin-bottom:16px;">
    <div class="form-body">

        <form id="importForm" action="{{ route('admin.buku.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file" id="excelFile" accept=".xlsx,.xls,.csv" required>

            <button type="submit" class="btn-submit" style="margin-top:10px;">
                Import Excel
            </button>

        </form>

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

    /* Live preview */
    function syncPreview(id, targetId, fallback) {
        const el = document.getElementById(id);
        const target = document.getElementById(targetId);
        if (!el || !target) return;
        el.addEventListener('input', () => {
            target.textContent = el.value.trim() || fallback;
        });
    }

    syncPreview('judul',       'previewJudul',      'Judul Buku');
    syncPreview('pengarang',   'previewPengarang',  'Nama Pengarang');
    syncPreview('penerbit',    'previewPenerbit',   '—');
    syncPreview('tahun_terbit','previewTahun',      '—');
    syncPreview('stok',        'previewStok',       '—');

    /* Cover upload preview */
    const imageInput = document.getElementById('imageInput');
    const uploadZone = document.getElementById('uploadZone');
    const uploadDefault = document.getElementById('uploadDefault');
    const uploadSuccess = document.getElementById('uploadSuccess');
    const fileNameEl = document.getElementById('fileName');
    const previewCover = document.getElementById('previewCover');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        /* Update zone */
        uploadZone.classList.add('has-file');
        uploadDefault.style.display = 'none';
        uploadSuccess.style.display = 'block';
        fileNameEl.textContent = file.name.length > 24
            ? file.name.substring(0, 22) + '…'
            : file.name;

        /* Update preview cover */
        const reader = new FileReader();
        reader.onload = (e) => {
            previewCover.innerHTML = `<img src="${e.target.result}" alt="Cover preview">`;
        };
        reader.readAsDataURL(file);
    });
</script>

</body>
</html>