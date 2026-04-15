<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white p-6">
            <h2 class="text-2xl font-bold mb-8">📚 Admin</h2>

            <nav class="space-y-4">
                <a href="/dashboard" class="block hover:bg-gray-700 px-3 py-2 rounded">
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="block hover:bg-gray-700 px-3 py-2 rounded">
                    Kelola User
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 p-8">
            @yield('content')
        </div>

    </div>

</body>
</html>
