<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori — Perpustakaan Digital</title>
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

        /* ── SIDEBAR ── */
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

        .topbar-greeting {
            font-size: 11px; color: var(--muted);
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px;
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 900; letter-spacing: -0.6px; line-height: 1;
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .topbar-date-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 7px 14px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 100px; font-size: 12px; color: var(--muted);
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
            width: 6px; height: 6px;
            background: var(--accent); border-radius: 50%;
            border: 1.5px solid var(--paper);
        }

        /* ── HERO BAND ── */
        .hero-band {
            background: var(--ink);
            padding: 28px 36px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 20px;
        }

        .hero-welcome {
            font-size: 11px; color: rgba(255,255,255,0.4);
            text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 6px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px; font-weight: 900; color: white;
            letter-spacing: -0.8px; line-height: 1.1;
        }
        .hero-title span { color: var(--accent-light); }

        .hero-sub { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 6px; }

        /* ── CONTENT ── */
        .content { padding: 28px 36px; display: grid; grid-template-columns: 360px 1fr; gap: 20px; align-items: start; }

        /* ── PANEL ── */
        .panel {
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(13,13,13,0.03);
        }

        .panel-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            background: white;
            display: flex; justify-content: space-between; align-items: center;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 16px; font-weight: 700; letter-spacing: -0.3px;
        }
        .panel-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }
        .panel-body { padding: 22px 24px; }

        /* ── FORM TAMBAH ── */
        .form-group { display: flex; flex-direction: column; gap: 8px; }

        .form-label {
            font-size: 11px; font-weight: 500; color: var(--muted);
            text-transform: uppercase; letter-spacing: 1px;
        }

        .form-input {
            width: 100%; padding: 11px 14px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; color: var(--ink);
            outline: none; transition: all 0.2s;
        }
        .form-input::placeholder { color: var(--muted); }
        .form-input:focus { border-color: var(--accent); background: white; box-shadow: 0 0 0 3px rgba(200,98,42,0.08); }

        .btn-tambah {
            width: 100%; margin-top: 10px;
            display: flex; align-items: center; justify-content: center; gap: 7px;
            padding: 11px 18px;
            background: var(--ink); color: white;
            border: none; border-radius: 10px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-tambah svg { width: 14px; height: 14px; }
        .btn-tambah:hover { background: var(--accent); box-shadow: 0 4px 14px rgba(200,98,42,0.25); }

        /* ── ALERT SUCCESS ── */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            padding: 11px 14px;
            background: #f0fdf4; border: 1px solid #bbf7d0;
            border-radius: 10px; margin-bottom: 16px;
            font-size: 12px; color: #15803d; font-weight: 500;
        }
        .alert-success svg { width: 15px; height: 15px; flex-shrink: 0; }

        /* ── COUNT BADGE ── */
        .count-badge {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 24px; height: 24px; padding: 0 8px;
            background: var(--accent); color: white;
            border-radius: 100px; font-size: 11px; font-weight: 600;
        }

        /* ── TABLE ── */
        .table-wrap { overflow: hidden; }

        .kat-list { display: flex; flex-direction: column; gap: 6px; }

        .kat-item {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 16px;
            background: var(--cream); border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s;
            animation: fadeUp 0.4s ease both;
        }
        .kat-item:hover { background: white; border-color: rgba(13,13,13,0.15); transform: translateX(3px); }

        .kat-num {
            width: 26px; height: 26px; min-width: 26px;
            border-radius: 8px; background: var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 600; color: var(--muted);
        }

        .kat-icon {
            width: 36px; height: 36px; min-width: 36px;
            border-radius: 10px; background: #fff7ed;
            display: flex; align-items: center; justify-content: center;
            color: var(--accent);
        }
        .kat-icon svg { width: 16px; height: 16px; }

        .kat-name { flex: 1; font-size: 13px; font-weight: 500; color: var(--ink); }

        .btn-hapus {
            display: flex; align-items: center; gap: 5px;
            padding: 6px 12px;
            background: transparent; color: var(--muted);
            border: 1px solid var(--border); border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-hapus svg { width: 12px; height: 12px; }
        .btn-hapus:hover { background: #fef2f2; color: #dc2626; border-color: #fecaca; }

        .empty-state {
            text-align: center; padding: 40px 20px;
            color: var(--muted);
        }
        .empty-state svg { width: 40px; height: 40px; margin: 0 auto 12px; display: block; opacity: 0.3; }
        .empty-state p { font-size: 13px; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
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
<a href="{{ route('admin.kategori.index') }}" class="sidebar-link active">
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
            <div>
                <div class="topbar-greeting">Manajemen Buku</div>
                <div class="topbar-title">Kategori</div>
            </div>
        </div>
        <div class="topbar-right">
            <div class="topbar-date-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span id="topbarDate">—</span>
            </div>
            <button class="notif-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <span class="notif-dot"></span>
            </button>
        </div>
    </div>

    <!-- HERO BAND -->
    <div class="hero-band">
        <div>
            <div class="hero-welcome">Manajemen Buku</div>
            <div class="hero-title">Kategori<span>.</span></div>
            <div class="hero-sub">Kelola dan atur semua kategori koleksi buku perpustakaan.</div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- FORM TAMBAH -->
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Tambah Kategori</div>
                    <div class="panel-sub">Masukkan nama kategori baru</div>
                </div>
            </div>
            <div class="panel-body">
                @if(session('success'))
                <div class="alert-success">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Kategori</label>
                        <input
                            type="text"
                            name="nama_kategori"
                            class="form-input"
                            placeholder="Contoh: Fiksi, Sains, Sejarah..."
                            required
                        >
                    </div>
                    <button type="submit" class="btn-tambah">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Tambah Kategori
                    </button>
                </form>
            </div>
        </div>

        <!-- DAFTAR KATEGORI -->
        <div class="panel">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Daftar Kategori</div>
                    <div class="panel-sub">Semua kategori yang tersedia</div>
                </div>
                <span class="count-badge">{{ $kategori->count() }}</span>
            </div>
            <div class="panel-body">
                <div class="kat-list">
                    @forelse($kategori as $k)
                    <div class="kat-item" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                        <div class="kat-num">{{ $loop->iteration }}</div>
                        <div class="kat-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/></svg>
                        </div>
                        <div class="kat-name">{{ $k->nama_kategori }}</div>
                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a2 2 0 012-2z"/></svg>
                        <p>Belum ada kategori. Tambahkan kategori pertama!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</main>

<script>
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const hari  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const now   = new Date();
    document.getElementById('topbarDate').textContent =
        hari[now.getDay()] + ', ' + now.getDate() + ' ' + bulan[now.getMonth()] + ' ' + now.getFullYear();
</script>

</body>
</html>