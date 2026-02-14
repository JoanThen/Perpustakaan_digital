<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .book-card {
            transition: all 0.3s ease;
        }

        .book-card:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-50 to-indigo-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-2xl border-r border-gray-200 z-50">
        <!-- Logo/Brand -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="h-12 w-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-800">Perpustakaan</h1>
                    <p class="text-xs text-gray-500">Digital Library</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('user.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <!-- Home / Browse Books -->
            <a href="{{ route('home') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari Buku
            </a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4">Peminjaman</p>
            </div>

            <!-- My Transactions -->
            <a href="{{ route('transaksi.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Riwayat Peminjaman
            </a>

            <!-- Active Loans -->
            <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                Sedang Dipinjam
            </a>

        <!-- User Profile at Bottom -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">Member</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition duration-300 font-medium text-sm flex items-center justify-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 min-h-screen">
        <!-- Top Header -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
            <div class="px-8 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->name ?? 'User' }}! 👋</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Notification Bell -->
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- Current Date -->
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ date('l') }}</p>
                            <p class="text-sm font-semibold text-gray-700">{{ date('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="p-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl shadow-2xl overflow-hidden mb-8 fade-in">
                <div class="p-8 relative">
                    <div class="flex items-center justify-between">
                        <div class="text-white">
                            <h3 class="text-2xl font-bold mb-2">Selamat Membaca! 📚</h3>
                            <p class="text-purple-100 mb-6">Temukan buku favoritmu dan mulai petualangan literasi</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition shadow-lg">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Jelajahi Koleksi Buku
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <svg class="h-40 w-40 text-white opacity-20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Total Transaksi Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Total</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $transaksiSaya }}</h3>
                        <p class="text-sm text-gray-500">Total Peminjaman</p>
                    </div>
                </div>

                <!-- Active Loans Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in" style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Aktif</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">0</h3>
                        <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                    </div>
                </div>

                <!-- Books Read Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in" style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Selesai</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $transaksiSaya }}</h3>
                        <p class="text-sm text-gray-500">Buku Dibaca</p>
                    </div>
                </div>

            </div>

         

            

        </div>
    </main>

    <script>
        // Highlight active menu
        const currentPath = window.location.pathname;
        const menuLinks = document.querySelectorAll('.sidebar-link');
        
        menuLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    </script>

</body>
</html>