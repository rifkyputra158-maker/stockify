@extends('layouts.guest')

@section('content')
<style>
    @keyframes shake {
        10%, 90% { transform: translateX(-1px); }
        20%, 80% { transform: translateX(2px); }
        30%, 50%, 70% { transform: translateX(-4px); }
        40%, 60% { transform: translateX(4px); }
    }
    .anim-shake { animation: shake 0.5s ease-in-out; }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .anim-spin { animation: spin 0.7s linear infinite; }
</style>

    <h2 class="anim-fade-up text-2xl font-bold text-slate-900 mb-1">Selamat Datang Kembali</h2>
    <p class="anim-fade-up text-sm text-slate-500 mb-8">Masuk ke akun kamu untuk melanjutkan.</p>

    @if (session('status'))
        <div class="anim-fade-up mb-5 p-3 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" id="login-form">
        @csrf

        <!-- Email -->
        <div class="anim-fade-up">
            <label for="email" class="block mb-1.5 text-sm font-medium text-slate-700">Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 transition-colors duration-200 group-focus-within:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="nama@perusahaan.com"
                       class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border {{ $errors->has('email') ? 'border-red-300 anim-shake' : 'border-slate-200' }} rounded-xl text-sm text-slate-900 placeholder-slate-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white">
            </div>
            @error('email')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="anim-fade-up-1">
            <label for="password" class="block mb-1.5 text-sm font-medium text-slate-700">Password</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 transition-colors duration-200 group-focus-within:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full pl-11 pr-11 py-2.5 bg-slate-50 border {{ $errors->has('password') ? 'border-red-300 anim-shake' : 'border-slate-200' }} rounded-xl text-sm text-slate-900 placeholder-slate-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white">
                <button type="button" id="toggle-password"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-blue-600 transition-colors duration-200">
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember + Forgot -->
        <div class="anim-fade-up-1 flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition-colors">
                <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" id="login-button"
                class="anim-fade-up-2 group w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-medium rounded-xl text-sm px-5 py-3 transition-all duration-200 hover:shadow-lg hover:shadow-blue-200 disabled:opacity-70 disabled:cursor-not-allowed">
            <svg id="button-spinner" class="hidden anim-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            <span id="button-text">Masuk</span>
            <svg id="button-arrow" class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    <p class="anim-fade-up-2 mt-8 text-center text-xs text-slate-400">
        Butuh bantuan? Hubungi administrator sistem kamu.
    </p>

    <script>
        document.getElementById('toggle-password')?.addEventListener('click', function () {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        });

        document.getElementById('login-form')?.addEventListener('submit', function () {
            const button = document.getElementById('login-button');
            const spinner = document.getElementById('button-spinner');
            const text = document.getElementById('button-text');
            const arrow = document.getElementById('button-arrow');

            button.disabled = true;
            spinner.classList.remove('hidden');
            arrow.classList.add('hidden');
            text.textContent = 'Memproses...';
        });
    </script>
@endsection