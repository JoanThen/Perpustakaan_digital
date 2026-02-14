<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-100 via-purple-50 to-indigo-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl bg-white shadow-2xl rounded-3xl p-10 border border-gray-100">

    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Edit Buku</h1>
        <p class="text-gray-500 text-sm mt-2">Perbarui data buku yang dipilih</p>
    </div>

    <!-- Error -->
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-100 text-red-700 border border-red-200">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700">Judul</label>
            <input type="text" name="judul"
                value="{{ old('judul', $buku->judul) }}"
                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Pengarang</label>
            <input type="text" name="pengarang"
                value="{{ old('pengarang', $buku->pengarang) }}"
                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Penerbit</label>
            <input type="text" name="penerbit"
                value="{{ old('penerbit', $buku->penerbit) }}"
                class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Tahun Terbit</label>
                <input type="number" name="tahun_terbit"
                    value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
                    class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700">Stok</label>
                <input type="number" name="stok"
                    value="{{ old('stok', $buku->stok) }}"
                    class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                    required>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-6">
            <a href="{{ route('admin.buku.index') }}"
               class="px-5 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                Kembali
            </a>

            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-lg hover:scale-105 transition duration-300">
                Update Buku
            </button>
        </div>

    </form>
</div>

</body>
</html>
