@extends('layouts.guest')

@section('content')
<style>
    /* Animasi Typewriter Looping */
    @keyframes typing {
        0% { width: 0; }
        60% { width: 100%; }
        80%, 100% { width: 100%; } /* Jeda setelah selesai mengetik */
    }
    @keyframes reset {
        0%, 90% { opacity: 1; }
        95%, 100% { opacity: 0; } /* Menghilang sebelum mengulang */
    }
    @keyframes blink { 0%, 100% { border-color: #1e293b; } 50% { border-color: transparent; } }

    .typewriter {
        overflow: hidden; 
        white-space: nowrap; 
        border-right: 2px solid #1e293b;
        width: 0;
        /* Durasi 4s: 3s mengetik, 1s jeda sebelum reset */
        animation: typing 4s steps(30, end) infinite, 
                   blink 0.75s step-end infinite;
    }

    /* Animasi Error Halus */
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    .error-anim { animation: fadeInDown 0.4s ease-out forwards; }

    /* Animasi Asli yang Dipertahankan */
    @keyframes shake { 10%, 90% { transform: translateX(-1px); } 20%, 80% { transform: translateX(2px); } 30%, 50%, 70% { transform: translateX(-4px); } 40%, 60% { transform: translateX(4px); } }
    .anim-shake { animation: shake 0.5s ease-in-out; }
    @keyframes spin { to { transform: rotate(360deg); } }
    .anim-spin { animation: spin 0.7s linear infinite; }
    @keyframes pulseGlow { 0%, 100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.35); } 50% { box-shadow: 0 0 0 8px rgba(37, 99, 235, 0); } }
    .anim-pulse-glow { animation: pulseGlow 2.5s ease-in-out infinite; }
    .anim-pulse-glow:hover { animation: none; }
    @keyframes popIn { 0% { transform: scale(0.5); opacity: 0; } 70% { transform: scale(1.15); opacity: 1; } 100% { transform: scale(1); } }
    .anim-pop { animation: popIn 0.4s ease-out both; }

    .link-underline { position: relative; }
    .link-underline::after {
        content: ''; position: absolute; left: 0; bottom: -2px; width: 100%; height: 1.5px;
        background-color: currentColor; transform: scaleX(0); transform-origin: left;
        transition: transform 0.25s ease-out;
    }
    .link-underline:hover::after { transform: scaleX(1); }
</style>

    <h2 class="typewriter text-2xl font-bold text-slate-900 mb-1 w-fit">Selamat Datang Kembali</h2>
    <p class="text-sm text-slate-500 mb-8">Masuk ke akun kamu untuk melanjutkan.</p>

    @if (session('status'))
        <div class="mb-5 p-3 flex items-center gap-2 text-sm text-green-800 rounded-lg bg-green-50 border border-green-100 error-anim">
            <svg class="anim-pop w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5" id="login-form">
        @csrf
        <div class="group">
            <label for="email" class="block mb-1.5 text-sm font-medium text-slate-700">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border {{ $errors->has('email') ? 'border-red-300 anim-shake' : 'border-slate-200' }} rounded-xl text-sm transition-all focus:ring-2 focus:ring-blue-500">
            </div>
            @error('email') <p class="mt-1.5 text-sm text-red-600 error-anim">{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label for="password" class="block mb-1.5 text-sm font-medium text-slate-700">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input id="password" type="password" name="password" required
                       class="w-full pl-11 pr-11 py-2.5 bg-slate-50 border {{ $errors->has('password') ? 'border-red-300 anim-shake' : 'border-slate-200' }} rounded-xl text-sm transition-all focus:ring-2 focus:ring-blue-500">
                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
            @error('password') <p class="mt-1.5 text-sm text-red-600 error-anim">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="link-underline text-sm font-medium text-blue-600" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" id="login-button" class="anim-pulse-glow w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl text-sm px-5 py-3 transition-all">
            <svg id="button-spinner" class="hidden anim-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
            <span id="button-text">Masuk</span>
            <svg id="button-arrow" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </button>
    </form>

    <script>
        document.getElementById('toggle-password')?.addEventListener('click', function () {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        });
        document.getElementById('login-form')?.addEventListener('submit', function () {
            const btn = document.getElementById('login-button');
            btn.disabled = true;
            document.getElementById('button-spinner').classList.remove('hidden');
            document.getElementById('button-arrow').classList.add('hidden');
            document.getElementById('button-text').textContent = 'Memproses...';
        });
    </script>
@endsection