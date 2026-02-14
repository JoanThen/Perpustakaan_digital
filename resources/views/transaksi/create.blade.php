<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-50 to-indigo-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-xl bg-white shadow-2xl rounded-3xl p-10 border border-gray-100">

    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Pinjam Buku</h1>
        <p class="text-gray-500 text-sm mt-2">Pilih buku yang ingin dipinjam</p>
    </div>

    <!-- Error Alert -->
    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Pilih Buku
            </label>

            <select name="buku_id"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">

                @foreach($buku as $item)
                    <option value="{{ $item->id }}"
                        @if($item->stok == 0) disabled @endif>
                        {{ $item->judul }} (Stok: {{ $item->stok }})
                    </option>
                @endforeach

            </select>

            <p class="text-xs text-gray-400 mt-2">
                Buku dengan stok 0 tidak dapat dipinjam.
            </p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-6">
            <a href="{{ route('transaksi.index') }}"
               class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                Kembali
            </a>

            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:scale-105 transition duration-300">
                Pinjam Sekarang
            </button>
        </div>

    </form>

</div>

</body>
</html>
