<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 relative overflow-hidden">

        <!-- Background Blur Circle -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>

        <div class="relative max-w-md w-full px-6">
            
            <!-- Card -->
            <div class="backdrop-blur-xl bg-white/70 shadow-2xl rounded-3xl p-10 border border-white/40">

                <!-- Logo -->
                <div class="text-center mb-8">
                    <div class="mx-auto w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-3xl flex items-center justify-center shadow-lg shadow-purple-300/40">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h2 class="mt-6 text-3xl font-bold text-gray-800 tracking-tight">
                        Buat Akun Baru
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Bergabung dengan Perpustakaan Digital
                    </p>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" class="text-gray-700 font-medium" />
                        <x-text-input id="name" name="name" type="text"
                            class="mt-2 w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                            required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" value="Email" class="text-gray-700 font-medium" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-2 w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" class="text-gray-700 font-medium" />
                        <x-text-input id="password" name="password" type="password"
                            class="mt-2 w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                            required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm -->
                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700 font-medium" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-2 w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200"
                            required />
                    </div>

                    <!-- Button -->
                    <x-primary-button
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 shadow-lg shadow-purple-300/40 transition-all duration-300 hover:scale-[1.02]">
                        Daftar Sekarang
                    </x-primary-button>

                    <!-- Login -->
                    <div class="text-center text-sm text-gray-600 mt-6">
                        Sudah punya akun?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-purple-600 hover:text-purple-800 transition">
                            Login di sini
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
