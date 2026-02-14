<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-50 to-indigo-100 min-h-screen">

<div class="max-w-6xl mx-auto py-12 px-6">

<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">📚 Data Buku</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola data buku perpustakaan</p>
    </div>

    <div class="flex gap-3">

        <a href="{{ route('admin.dashboard') }}"
           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition duration-300">
            ← Dashboard
        </a>

        <a href="{{ route('admin.buku.create') }}"
           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl shadow-lg hover:scale-105 transition duration-300">
            + Tambah Buku
        </a>

    </div>
</div>


    <!-- Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Judul</th>
                        <th class="px-6 py-4 text-left">Pengarang</th>
                        <th class="px-6 py-4 text-left">Penerbit</th>
                        <th class="px-6 py-4 text-left">Tahun</th>
                        <th class="px-6 py-4 text-left">Stok</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($buku as $item)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $item->judul }}
                        </td>
                        <td class="px-6 py-4">{{ $item->pengarang }}</td>
                        <td class="px-6 py-4">{{ $item->penerbit }}</td>
                        <td class="px-6 py-4">{{ $item->tahun_terbit }}</td>

                        <!-- Stok Badge -->
                        <td class="px-6 py-4">
                            @if($item->stok > 5)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                    {{ $item->stok }} Tersedia
                                </span>
                            @elseif($item->stok > 0)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    {{ $item->stok }} Hampir Habis
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-4 text-center space-x-2">

                            <a href="{{ route('admin.buku.edit', $item->id) }}"
                               class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.buku.destroy', $item->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Yakin hapus?')"
                                    class="px-4 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                    @if($buku->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400">
                            Belum ada data buku.
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
