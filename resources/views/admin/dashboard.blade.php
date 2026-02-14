<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan Digital</title>
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
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link active flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4">Manajemen Buku</p>
            </div>

            <!-- Daftar Buku -->
            <a href="{{ route('admin.buku.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Daftar Buku
            </a>

            <!-- Tambah Buku -->
            <a href="{{ route('admin.buku.create') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Buku
            </a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4">Manajemen User</p>
            </div>

            <!-- Kelola User -->
            <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Kelola User
            </a>

            <!-- Divider -->
            <div class="pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4">Lainnya</p>
            </div>

            <!-- Transaksi -->
            <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
                Transaksi
            </a>

            <!-- Laporan -->
            <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-medium">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Laporan
            </a>
        </nav>

        <!-- User Profile at Bottom -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
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
                        <p class="text-sm text-gray-500 mt-1">Selamat datang di panel administrasi</p>
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
            
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Total Buku Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Koleksi</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalBuku }}</h3>
                        <p class="text-sm text-gray-500">Total Buku</p>
                        <div class="mt-4 flex items-center text-green-600 text-xs font-semibold">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            +12% dari bulan lalu
                        </div>
                    </div>
                </div>

                <!-- Total Dipinjam Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in" style="animation-delay: 0.1s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1 rounded-full">Aktif</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalDipinjam }}</h3>
                        <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                        <div class="mt-4 flex items-center text-orange-600 text-xs font-semibold">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            5 jatuh tempo hari ini
                        </div>
                    </div>
                </div>

                <!-- Total Transaksi Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in" style="animation-delay: 0.2s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Total</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalTransaksi }}</h3>
                        <p class="text-sm text-gray-500">Total Transaksi</p>
                        <div class="mt-4 flex items-center text-green-600 text-xs font-semibold">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            98% selesai tepat waktu
                        </div>
                    </div>
                </div>

                <!-- Stok Tersedia Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 card-hover fade-in" style="animation-delay: 0.3s">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="h-14 w-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-3 py-1 rounded-full">Tersedia</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ $totalTersedia }}</h3>
                        <p class="text-sm text-gray-500">Stok Tersedia</p>
                        <div class="mt-4 flex items-center text-purple-600 text-xs font-semibold">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Stok aman
                        </div>
                    </div>
                </div>

            </div>

            <!-- Chart & Activity Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                
                <!-- Chart Card (2/3 width) -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 fade-in">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Statistik Peminjaman</h3>
                        <p class="text-sm text-gray-500">Data 7 hari terakhir</p>
                    </div>
                    <div class="p-6">
                        <!-- Placeholder for Chart -->
                        <div class="h-64 flex items-center justify-center bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl">
                            <div class="text-center">
                                <svg class="h-16 w-16 text-purple-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-gray-400">Chart Area</p>
                            </div>
                        </div>
                    </div>
                </div>

             

                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Action Button -->
                        <a href="{{ route('admin.buku.create') }}" class="p-6 border-2 border-gray-200 rounded-xl hover:border-purple-500 hover:bg-purple-50 transition group text-center">
                            <div class="h-12 w-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-600 transition">
                                <svg class="h-6 w-6 text-purple-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700 group-hover:text-purple-600">Tambah Buku</p>
                        </a>

                        <!-- Action Button -->
                        <a href="{{ route('admin.buku.index') }}" class="p-6 border-2 border-gray-200 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition group text-center">
                            <div class="h-12 w-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-600 transition">
                                <svg class="h-6 w-6 text-blue-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700 group-hover:text-blue-600">Lihat Buku</p>
                        </a>

                        <!-- Action Button -->
                        <a href="{{ route('admin.users.index') }}" class="p-6 border-2 border-gray-200 rounded-xl hover:border-green-500 hover:bg-green-50 transition group text-center">
                            <div class="h-12 w-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-green-600 transition">
                                <svg class="h-6 w-6 text-green-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700 group-hover:text-green-600">Kelola User</p>
                        </a>

                        <!-- Action Button -->
                        <a href="#" class="p-6 border-2 border-gray-200 rounded-xl hover:border-orange-500 hover:bg-orange-50 transition group text-center">
                            <div class="h-12 w-12 bg-orange-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-orange-600 transition">
                                <svg class="h-6 w-6 text-orange-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700 group-hover:text-orange-600">Lihat Laporan</p>
                        </a>
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