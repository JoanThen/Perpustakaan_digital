<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-50 to-indigo-100 min-h-screen">

<div class="max-w-6xl mx-auto py-12 px-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">📖 Daftar Transaksi</h1>
            <p class="text-gray-500 text-sm mt-1">Data peminjaman dan pengembalian buku</p>
        </div>
        <a href="{{ route('user.dashboard') }}"
           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition duration-300">
            ← Dashboard
        </a>

        <a href="{{ route('transaksi.create') }}"
           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl shadow-lg hover:scale-105 transition duration-300">
            + Pinjam Buku
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">User</th>
                        <th class="px-6 py-4 text-left">Buku</th>
                        <th class="px-6 py-4 text-left">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach($transaksi as $item)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->buku->judul }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4">
                            @if($item->status == 'dipinjam')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Dipinjam
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    Dikembalikan
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4 text-center">
                            @if($item->status == 'dipinjam')
                                <a href="{{ route('transaksi.kembali', $item->id) }}"
                                   class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">
                                    Kembalikan
                                </a>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach

                    @if($transaksi->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400">
                            Belum ada transaksi.
                        </td>
                    </tr>
                    @endif

                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>
