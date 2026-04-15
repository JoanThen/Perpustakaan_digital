@extends('layouts.app')

@section('content')
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
        font-size: 13px; font-weight: 500;
        color: rgba(255,255,255,0.5); text-decoration: none;
        transition: all 0.2s; margin-bottom: 2px;
    }

    .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }
    .sidebar-link:hover { background: rgba(255,255,255,0.07); color: white; }
    .sidebar-link.active { background: var(--accent); color: white; }

    .sidebar-user { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.07); }
    .sidebar-user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }

    .avatar {
        width: 34px; height: 34px; background: var(--accent);
        border-radius: 50%; display: flex; align-items: center;
        justify-content: center; font-size: 13px; font-weight: 700;
        color: white; flex-shrink: 0;
    }

    .sidebar-user-name { font-size: 13px; font-weight: 500; color: white; line-height: 1.2; }
    .sidebar-user-role { font-size: 11px; color: rgba(255,255,255,0.35); }

    .btn-logout {
        width: 100%; padding: 9px;
        background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.5);
        border: 1px solid rgba(255,255,255,0.08); border-radius: 8px;
        font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
        cursor: pointer; display: flex; align-items: center;
        justify-content: center; gap: 6px; transition: all 0.2s;
    }

    .btn-logout svg { width: 14px; height: 14px; }
    .btn-logout:hover { background: rgba(200,98,42,0.2); color: var(--accent-light); border-color: rgba(200,98,42,0.3); }

    .main { margin-left: var(--sidebar-w); min-height: 100vh; }

    .topbar {
        background: var(--paper); border-bottom: 1px solid var(--border);
        padding: 20px 36px; display: flex; justify-content: space-between;
        align-items: center; position: sticky; top: 0; z-index: 40;
    }

    .topbar-title { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 900; letter-spacing: -0.8px; }
    .topbar-sub { font-size: 13px; color: var(--muted); margin-top: 2px; }

    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 18px; background: none; border: 1px solid var(--border);
        border-radius: 100px; font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500; color: var(--muted);
        text-decoration: none; transition: all 0.2s;
    }

    .btn-back:hover { border-color: var(--ink); color: var(--ink); }

    .content { padding: 40px 36px; display: flex; justify-content: center; }

    .form-card {
        width: 100%; max-width: 520px;
        background: var(--paper); border: 1px solid var(--border);
        border-radius: 20px; padding: 40px;
    }

    .error-box {
        background: #fef2f2; border: 1px solid #fecaca;
        color: #dc2626; padding: 12px 16px;
        border-radius: 10px; font-size: 13px; margin-bottom: 28px;
    }

    .error-box ul { list-style: disc; padding-left: 16px; }
    .error-box li { margin-bottom: 2px; }

    .form-group { margin-bottom: 20px; }

    label {
        display: block; font-size: 11px; font-weight: 500;
        letter-spacing: 0.8px; text-transform: uppercase;
        color: var(--muted); margin-bottom: 7px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%; padding: 12px 14px;
        font-family: 'DM Sans', sans-serif; font-size: 14px;
        color: var(--ink); background: var(--cream);
        border: 1px solid var(--border); border-radius: 10px;
        outline: none; transition: border-color 0.2s, box-shadow 0.2s;
    }

    input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(200,98,42,0.1); }

    .role-options {
        display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
    }

    .role-option { display: none; }

    .role-label {
        display: flex; flex-direction: column; align-items: center;
        gap: 8px; padding: 16px 12px;
        border: 1px solid var(--border); border-radius: 10px;
        cursor: pointer; background: var(--cream); transition: all 0.2s;
    }

    .role-label:hover { border-color: var(--accent-light); }

    .role-option:checked + .role-label {
        border-color: var(--accent);
        background: var(--paper);
        box-shadow: 0 0 0 3px rgba(200,98,42,0.1);
    }

    .role-icon {
        width: 36px; height: 36px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
    }

    .role-icon.admin { background: #f3e8ff; color: #9333ea; }
    .role-icon.user  { background: #f1f5f9; color: #64748b; }
    .role-icon svg   { width: 18px; height: 18px; }

    .role-text { font-size: 12px; font-weight: 500; color: var(--ink); }
    .role-option:checked + .role-label .role-text { color: var(--accent); }

    .form-divider { border: none; border-top: 1px solid var(--border); margin: 8px 0 24px; }

    .form-actions { display: flex; justify-content: space-between; align-items: center; }

    .btn-cancel {
        display: inline-block; padding: 10px 20px; background: none;
        border: 1px solid var(--border); border-radius: 100px;
        font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
        color: var(--muted); text-decoration: none; transition: all 0.2s;
    }

    .btn-cancel:hover { border-color: var(--ink); color: var(--ink); }

    .btn-submit {
        padding: 10px 28px; background: var(--ink); color: var(--cream);
        border: none; border-radius: 100px; font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s;
    }

    .btn-submit:hover { background: var(--accent); box-shadow: 0 6px 20px rgba(200,98,42,0.25); }
</style>

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
    Transaksi
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

    <div class="topbar">
        <div>
            <div class="topbar-title">Tambah User</div>
            <div class="topbar-sub">Isi data untuk membuat akun pengguna baru</div>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-back">← Kembali</a>
    </div>

    <div class="content">
        <div class="form-card">

            @if($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}" placeholder="contoh@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Minimal 6 karakter" required>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <div class="role-options">
                        <div>
                            <input type="radio" name="role" id="role_admin" value="admin" class="role-option"
                                {{ old('role', 'admin') == 'admin' ? 'checked' : '' }}>
                            <label for="role_admin" class="role-label">
                                <div class="role-icon admin">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                </div>
                                <span class="role-text">Admin</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="role" id="role_user" value="user" class="role-option"
                                {{ old('role') == 'user' ? 'checked' : '' }}>
                            <label for="role_user" class="role-label">
                                <div class="role-icon user">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                </div>
                                <span class="role-text">User</span>
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="form-divider">

                <div class="form-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn-cancel">Kembali</a>
                    <button type="submit" class="btn-submit">Simpan User</button>
                </div>

            </form>
        </div>
    </div>
</main>

<script>
    const currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            document.querySelectorAll('.sidebar-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        }
    });
</script>

@endsection