<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Perpustakaan Digital</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
            text-decoration: none;
            margin-bottom: 40px;
        }

        .brand span { color: var(--accent); }

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
            letter-spacing: -1px;
            margin-bottom: 6px;
        }

        .card-sub {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 32px;
        }

        .status-msg {
            font-size: 13px;
            color: #2d7a2d;
            background: #f0faf0;
            border: 1px solid #c3e6c3;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .form-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 7px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--ink);
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
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

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            margin-top: 4px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: var(--muted);
            cursor: pointer;
        }

        input[type="checkbox"] { accent-color: var(--accent); }

        .forgot {
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: color 0.2s, border-color 0.2s;
        }

        .forgot:hover { color: var(--accent); border-color: var(--accent); }

        .btn {
            width: 100%;
            padding: 13px;
            background: var(--ink);
            color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 100px;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn:hover {
            background: var(--accent);
            box-shadow: 0 8px 24px rgba(200,98,42,0.25);
        }

        .register {
            text-align: center;
            font-size: 13px;
            color: var(--muted);
            margin-top: 20px;
        }

        .register a {
            color: var(--ink);
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1.5px solid var(--ink);
            transition: color 0.2s, border-color 0.2s;
        }

        .register a:hover { color: var(--accent); border-color: var(--accent); }
    </style>
</head>
<body>

    <a href="{{ route('home') }}" class="brand">Perpustakaan<span>.</span></a>

    <div class="card">
        <h1 class="card-title">Masuk</h1>
        <p class="card-sub">Silakan login untuk melanjutkan.</p>

        @if (session('status'))
            <div class="status-msg">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email"
                    value="{{ old('email') }}" required autofocus placeholder="nama@email.com">
                @error('email')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required placeholder="••••••••">
                @error('password')<p class="error-msg">{{ $message }}</p>@enderror
            </div>

            <div class="row">
                <label class="remember">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn">Masuk</button>
        </form>

        @if (Route::has('register'))
            <p class="register">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        @endif
    </div>

</body>
</html>