<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Stockify') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">

    <div class="min-h-screen flex">

        <!-- Panel Branding (kiri, disembunyikan di layar kecil) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-blue-700 via-blue-600 to-green-600 overflow-hidden">
            <!-- Dekorasi lingkaran -->
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-white/10"></div>
            <div class="absolute bottom-0 right-0 w-72 h-72 rounded-full bg-white/10 translate-x-1/3 translate-y-1/3"></div>
            <div class="absolute top-1/3 right-10 w-40 h-40 rounded-full bg-green-400/20"></div>

            <div class="relative z-10 flex flex-col justify-between p-12 text-white w-full">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9M3.75 7.5v9l8.25 4.5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Stockify</span>
                </div>

                <div class="max-w-md">
                    <h1 class="text-3xl font-bold leading-tight mb-4">
                        Kelola stok gudang kamu dengan lebih mudah dan akurat.
                    </h1>
                    <p class="text-white/80 text-sm leading-relaxed">
                        Pantau barang masuk, keluar, dan stok minimum secara real-time. Satu platform untuk seluruh tim gudang kamu.
                    </p>

                    <div class="flex items-center gap-6 mt-8">
                        <div>
                            <p class="text-2xl font-bold">100%</p>
                            <p class="text-xs text-white/70">Akurasi Stok</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div>
                            <p class="text-2xl font-bold">3</p>
                            <p class="text-xs text-white/70">Level Akses Peran</p>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div>
                            <p class="text-2xl font-bold">24/7</p>
                            <p class="text-xs text-white/70">Pemantauan</p>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-white/60">&copy; {{ date('Y') }} Stockify. Aplikasi Manajemen Stok Barang.</p>
            </div>
        </div>

        <!-- Panel Form (kanan) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12 bg-white">
            <div class="w-full max-w-sm">
                <!-- Logo untuk mobile (tampil kalau panel kiri disembunyikan) -->
                <div class="flex lg:hidden items-center gap-2 mb-8">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9M3.75 7.5v9l8.25 4.5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-900">Stockify</span>
                </div>

                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>