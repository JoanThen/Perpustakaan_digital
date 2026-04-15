<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Perpustakaan Digital</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #0d0d0d;
            --paper: #f5f0e8;
            --cream: #faf7f2;
            --accent: #c8622a;
            --muted: #8a8070;
            --border: rgba(13,13,13,0.1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background: var(--paper);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .card-sub {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 32px;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
        }

        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(200,98,42,0.1);
        }

        .error-msg {
            font-size: 12px;
            color: #c0392b;
            margin-top: 5px;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: var(--ink);
            color: var(--cream);
            border: none;
            border-radius: 100px;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn:hover {
            background: var(--accent);
        }

        .login-link {
            text-align: center;
            font-size: 13px;
            color: var(--muted);
            margin-top: 20px;
        }

        .login-link a {
            color: var(--ink);
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1px solid var(--ink);
        }
    </style>
</head>
<body>

<div class="card">
    <h1 class="card-title">Daftar</h1>
    <p class="card-sub">Buat akun baru untuk memulai.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required>

            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>

            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            @error('password_confirmation')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Daftar Sekarang</button>
    </form>

    <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
    </div>
</div>

</body>
</html>