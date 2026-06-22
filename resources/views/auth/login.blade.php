@extends('layouts.app')

@section('title', 'Login - MyDuit')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 bg-surface">
    <div class="w-full max-w-md bg-surface-container-low border border-outline-variant/30 rounded-3xl p-8 shadow-sm">
        
        <!-- Header Actions: Back Button & Dark Mode Toggle -->
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded-full transition-all border border-outline-variant/30 shadow-sm font-semibold text-sm">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Kembali
            </a>
            <button type="button" data-theme-toggle aria-label="Ganti mode terang/gelap" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-on-surface hover:bg-surface-container-highest active:scale-90 transition-all border border-outline-variant/30">
                <span class="material-symbols-outlined text-xl" data-theme-icon>dark_mode</span>
            </button>
        </div>

        <div class="text-center mb-8">
            <span class="material-symbols-outlined text-primary text-5xl mb-2" data-weight="fill">account_balance_wallet</span>
            <h1 class="text-2xl font-bold font-display-balance text-on-surface">Masuk ke MyDuit</h1>
            <p class="text-on-surface-variant text-sm mt-2">Lanjut atur cashflow lo hari ini.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf
            
            @if ($errors->any())
                <div class="bg-error-container text-on-error-container p-4 rounded-xl text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col gap-2">
                <label for="email" class="text-sm font-semibold text-on-surface">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-surface text-on-surface border border-outline-variant rounded-xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="text-sm font-semibold text-on-surface">Password</label>
                <div class="relative w-full">
                    <input type="password" id="password" name="password" required
                        class="w-full bg-surface text-on-surface border border-outline-variant rounded-xl pl-4 py-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" style="padding-right: 3rem;">
                    <button type="button" onclick="togglePassword('password', 'eyeIcon')" class="absolute flex items-center justify-center rounded-full text-on-surface-variant hover:text-primary transition-colors cursor-pointer" style="right: 0.75rem; top: 50%; transform: translateY(-50%); width: 2rem; height: 2rem;">
                        <span id="eyeIcon" class="material-symbols-outlined" style="font-size: 1.25rem;">visibility</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between mt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary bg-surface">
                    <span class="text-sm text-on-surface-variant">Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-xl font-semibold hover:bg-primary-fixed-dim transition-colors mt-2 shadow-md">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-on-surface-variant mt-8">
            Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Daftar sekarang</a>
        </p>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerText = 'visibility_off';
        } else {
            input.type = 'password';
            icon.innerText = 'visibility';
        }
    }
</script>
@endsection
