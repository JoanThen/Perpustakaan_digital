<!DOCTYPE html>
<html lang="id">
<head>
    <title>Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
   <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #fafbfc;
        overflow-x: hidden;
    }

    /* NAVBAR */
    .navbar {
        position: fixed;
        width: 100%;
        top: 0;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        padding: 20px 60px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 1000;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.95);
        padding: 15px 60px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .navbar-brand {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .navbar-links {
        display: flex;
        gap: 30px;
        align-items: center;
    }

    .navbar a {
        color: #374151;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
        position: relative;
    }

    .navbar a:hover {
        color: #667eea;
    }

    .navbar a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: width 0.3s;
    }

    .navbar a:hover::after {
        width: 100%;
    }

    /* HERO */
    .hero {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 120px 20px 80px;
        overflow: hidden;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3), transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(138, 43, 226, 0.3), transparent 50%);
        animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
    }

    .hero h1 {
        font-size: 64px;
        font-weight: 800;
        margin-bottom: 24px;
        line-height: 1.2;
        animation: fadeInUp 1s ease;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .hero p {
        font-size: 22px;
        margin-bottom: 40px;
        opacity: 0.95;
        font-weight: 300;
        animation: fadeInUp 1s ease 0.2s backwards;
        line-height: 1.6;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        animation: fadeInUp 1s ease 0.4s backwards;
    }

    .btn {
        display: inline-block;
        padding: 16px 40px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 16px;
        border: 2px solid transparent;
    }

    .btn-primary {
        background: white;
        color: #667eea;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-outline:hover {
        background: white;
        color: #667eea;
        transform: translateY(-3px);
    }

    .hero-decorations {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 1;
    }

    .floating-book {
        position: absolute;
        font-size: 40px;
        opacity: 0.1;
        animation: float 20s infinite ease-in-out;
    }

    .floating-book:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
    .floating-book:nth-child(2) { top: 60%; left: 80%; animation-delay: 3s; }
    .floating-book:nth-child(3) { top: 40%; right: 15%; animation-delay: 6s; }
    .floating-book:nth-child(4) { bottom: 20%; left: 20%; animation-delay: 9s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(5deg); }
    }

    /* SECTION */
    .section {
        padding: 100px 60px;
        text-align: center;
    }

    .section-title {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .section-subtitle {
        font-size: 18px;
        color: #6b7280;
        margin-bottom: 60px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .card {
        background: white;
        padding: 40px 30px;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.25);
    }

    .card:hover::before {
        transform: scaleX(1);
    }

    .card-icon {
        font-size: 56px;
        margin-bottom: 20px;
        display: inline-block;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .card:hover .card-icon {
        animation: none;
        transform: scale(1.1) rotate(5deg);
        transition: transform 0.3s ease;
    }

    .card h3 {
        font-size: 24px;
        margin-bottom: 12px;
        color: #1f2937;
        font-weight: 700;
    }

    .card p {
        color: #6b7280;
        line-height: 1.6;
        font-size: 15px;
    }

    /* STATS SECTION */
    .stats-section {
        background: linear-gradient(135deg, #f6f8fc 0%, #ffffff 100%);
        position: relative;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(to bottom, rgba(102, 126, 234, 0.05), transparent);
    }

    .stat-card {
        background: white;
        padding: 50px 30px;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
    }

    .stat-number {
        font-size: 56px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
    }

    .stat-label {
        color: #6b7280;
        font-size: 16px;
        font-weight: 500;
    }

    /* FOOTER */
    .footer {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        color: white;
        padding: 60px 40px 30px;
        text-align: center;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-brand {
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .footer-text {
        color: #9ca3af;
        margin-bottom: 30px;
        font-size: 15px;
    }

    .footer-divider {
        border: none;
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 30px 0;
    }

    .footer-bottom {
        color: #9ca3af;
        font-size: 14px;
    }

    /* ANIMATIONS */
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .fade-in {
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .navbar {
            padding: 15px 20px;
        }

        .navbar.scrolled {
            padding: 12px 20px;
        }

        .navbar-links {
            gap: 15px;
        }

        .hero h1 {
            font-size: 40px;
        }

        .hero p {
            font-size: 18px;
        }

        .hero-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .section {
            padding: 60px 20px;
        }

        .section-title {
            font-size: 36px;
        }

        .cards {
            gap: 20px;
        }

        .stat-number {
            font-size: 48px;
        }
    }

</style>

</head>
<body>

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="navbar-brand">📚 Perpustakaan Digital</div>
        <div class="navbar-links">
            <!-- Laravel Blade syntax preserved -->
           @auth
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    @else
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
    @endif

    <a href="{{ route('profile.edit') }}">Profile</a>
@endauth

        </div>
    </div>

    <!-- HERO -->
    <div class="hero">
        <div class="hero-decorations">
            <div class="floating-book">📖</div>
            <div class="floating-book">📚</div>
            <div class="floating-book">📕</div>
            <div class="floating-book">📗</div>
        </div>

        <div class="hero-content">
            <h1>Sistem Manajemen Perpustakaan Modern</h1>
            <p>Kelola buku, transaksi peminjaman, dan data pengguna dengan sistem yang efisien, cepat, dan mudah digunakan.</p>

            <div class="hero-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Masuk Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
                    <a href="{{ route('register') }}" class="btn btn-outline">Daftar Gratis</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- FITUR -->
    <div class="section">
        <h2 class="section-title">Fitur Unggulan</h2>
        <p class="section-subtitle">Solusi lengkap untuk mengelola perpustakaan Anda dengan lebih efektif</p>

        <div class="cards">
            <div class="card fade-in">
                <div class="card-icon">📚</div>
                <h3>Manajemen Buku</h3>
                <p>Tambah, edit, dan kelola stok buku dengan antarmuka yang intuitif dan mudah digunakan.</p>
            </div>

            <div class="card fade-in" style="animation-delay: 0.1s">
                <div class="card-icon">🔄</div>
                <h3>Transaksi Peminjaman</h3>
                <p>Proses peminjaman dan pengembalian yang cepat, terstruktur, dan tercatat dengan baik.</p>
            </div>

            <div class="card fade-in" style="animation-delay: 0.2s">
                <div class="card-icon">👤</div>
                <h3>Sistem Login</h3>
                <p>Keamanan sistem terjamin dengan autentikasi pengguna yang aman dan terenkripsi.</p>
            </div>

            <div class="card fade-in" style="animation-delay: 0.3s">
                <div class="card-icon">📊</div>
                <h3>Laporan & Statistik</h3>
                <p>Pantau aktivitas perpustakaan dengan laporan dan statistik yang detail dan real-time.</p>
            </div>

            <div class="card fade-in" style="animation-delay: 0.4s">
                <div class="card-icon">🔍</div>
                <h3>Pencarian Cepat</h3>
                <p>Temukan buku yang Anda cari dengan sistem pencarian yang powerful dan akurat.</p>
            </div>

            <div class="card fade-in" style="animation-delay: 0.5s">
                <div class="card-icon">📱</div>
                <h3>Responsive Design</h3>
                <p>Akses sistem dari perangkat apapun - desktop, tablet, atau smartphone dengan sempurna.</p>
            </div>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="section stats-section">
        <h2 class="section-title">Statistik Perpustakaan</h2>
        <p class="section-subtitle">Data real-time dari sistem perpustakaan kami</p>

        <div class="cards">
            <div class="stat-card fade-in">
                <div class="stat-number">{{ $totalBuku }}</div>
                <div class="stat-label">Total Judul Buku</div>
            </div>

            <div class="stat-card fade-in" style="animation-delay: 0.1s">
                <div class="stat-number">{{ $totalStok }}</div>
                <div class="stat-label">Total Stok Buku</div>
            </div>

            <div class="stat-card fade-in" style="animation-delay: 0.2s">
                <div class="stat-number">{{ $totalDipinjam }}</div>
                <div class="stat-label">Buku Sedang Dipinjam</div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-brand">Perpustakaan Digital</div>
            <p class="footer-text">Sistem manajemen perpustakaan yang modern, efisien, dan mudah digunakan</p>
            
            <hr class="footer-divider">
            
            <div class="footer-bottom">
                © {{ date('Y') }} Perpustakaan Digital - Joan Imanuel. All rights reserved.
            </div>
        </div>
    </div>

    <script>
        // Navbar scroll effect
        window.addEventListener("scroll", function() {
            const navbar = document.querySelector(".navbar");
            navbar.classList.toggle("scrolled", window.scrollY > 50);
        });

        // Fade in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    </script>

</body>
</html>