@extends('layouts.app')

@section('title', 'Dashboard - MyDuit')

@section('content')
<div class="min-h-screen bg-surface flex flex-col relative">
    <!-- Navbar -->
    <header class="bg-surface-container-low border-b border-outline-variant/30 relative z-40">
        <div class="max-w-5xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 text-primary">
                <span class="material-symbols-outlined text-2xl" data-weight="fill">account_balance_wallet</span>
                <span class="font-display-balance text-xl font-bold tracking-tight">MyDuit</span>
            </div>
            
            <div class="flex items-center gap-4">
                <button type="button" data-theme-toggle aria-label="Ganti mode terang/gelap" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container text-on-surface hover:bg-surface-container-highest transition-all border border-outline-variant/30 cursor-pointer">
                    <span class="material-symbols-outlined text-xl" data-theme-icon>dark_mode</span>
                </button>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 bg-error hover:bg-error-container text-on-error hover:text-on-error-container px-4 py-2 rounded-xl transition-all font-semibold text-sm cursor-pointer shadow-sm">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 md:px-8 py-8 relative z-10">
        @if(session('success'))
        <div class="mb-4 bg-income-bg text-income-green p-4 rounded-xl text-sm border border-income-green/30 flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        <h1 class="text-3xl font-display-balance font-bold text-on-surface mb-1">Halo, {{ explode(' ', $user->name)[0] }}</h1>
        <p class="text-on-surface-variant mb-8">Ini ringkasan cashflow lo bulan ini.</p>

        <!-- Balance Card -->
        <!-- Balance Card -->
        <div class="bg-primary text-on-primary rounded-3xl relative overflow-hidden shadow-lg border border-white/10 mb-6" style="padding: 2rem;">
            <!-- Decorative circles -->
            <div class="absolute rounded-full pointer-events-none" style="top: -3rem; right: -3rem; width: 12rem; height: 12rem; background: rgba(255,255,255,0.15); filter: blur(40px);"></div>
            <div class="absolute rounded-full pointer-events-none" style="bottom: -2rem; left: -2rem; width: 8rem; height: 8rem; background: rgba(0,0,0,0.1); filter: blur(30px);"></div>
            
            <div style="position: relative; z-index: 10;">
                <p class="font-semibold opacity-90 text-sm tracking-wide uppercase" style="margin-bottom: 0.5rem;">Total Saldo Aktif</p>
                <h2 class="text-4xl md:text-5xl font-display-balance font-bold tracking-tight" style="margin-bottom: 1.5rem;">Rp {{ number_format($wallet->balance ?? 0, 0, ',', '.') }}</h2>
                
                <div class="flex gap-3" style="flex-wrap: wrap;">
                    <button onclick="window.openTransactionModal('income')" class="hover:bg-white/30 transition-colors backdrop-blur-md rounded-xl flex items-center gap-2 font-semibold text-sm cursor-pointer" style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem;">
                        <span class="material-symbols-outlined text-lg">add</span>
                        Pemasukan
                    </button>
                    <button onclick="window.openTransactionModal('expense')" class="hover:bg-black/30 transition-colors backdrop-blur-md rounded-xl flex items-center gap-2 font-semibold text-sm cursor-pointer" style="background: rgba(0,0,0,0.2); padding: 0.5rem 1rem;">
                        <span class="material-symbols-outlined text-lg">remove</span>
                        Pengeluaran
                    </button>
                </div>
            </div>
        </div>

        <!-- Monthly Summary Cards -->
        <!-- Monthly Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-bottom: 2rem;">
            <div class="bg-surface-container-low rounded-3xl border border-outline-variant/30 flex items-center" style="padding: 1.5rem; gap: 1rem;">
                <div class="rounded-full bg-income-bg flex items-center justify-center text-income-green" style="width: 3rem; height: 3rem; flex-shrink: 0;">
                    <span class="material-symbols-outlined">south_west</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-sm font-semibold">Pemasukan Bulan Ini</p>
                    <h3 class="text-xl font-bold font-display-balance text-on-surface">Rp {{ number_format($incomeThisMonth, 0, ',', '.') }}</h3>
                </div>
            </div>
            
            <div class="bg-surface-container-low rounded-3xl border border-outline-variant/30 flex items-center" style="padding: 1.5rem; gap: 1rem;">
                <div class="rounded-full bg-expense-bg flex items-center justify-center text-expense-red" style="width: 3rem; height: 3rem; flex-shrink: 0;">
                    <span class="material-symbols-outlined">north_east</span>
                </div>
                <div>
                    <p class="text-on-surface-variant text-sm font-semibold">Pengeluaran Bulan Ini</p>
                    <h3 class="text-xl font-bold font-display-balance text-on-surface">Rp {{ number_format($expenseThisMonth, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Recent Transactions -->
        <div class="flex justify-between items-center mb-4 mt-8">
            <h3 class="text-lg font-bold text-on-surface">Transaksi Terakhir</h3>
            <a href="{{ route('transactions.index') }}" class="text-primary text-sm font-semibold hover:underline">Lihat Semua</a>
        </div>

        @if($recentTransactions->isEmpty())
        <div class="bg-surface-container-low rounded-3xl p-12 border border-outline-variant/30 text-center shadow-sm">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4 opacity-50">receipt_long</span>
            <h3 class="text-lg font-bold text-on-surface mb-2">Belum ada transaksi</h3>
            <p class="text-sm text-on-surface-variant max-w-md mx-auto">Catatan pengeluaran dan pemasukan lo akan muncul di sini. Coba tambahkan transaksi pertama lo.</p>
        </div>
        @else
        <div class="bg-surface-container-low rounded-3xl border border-outline-variant/30 overflow-hidden shadow-sm">
            <div class="flex flex-col divide-y divide-outline-variant/30">
                @foreach($recentTransactions as $tx)
                <div class="flex items-center justify-between hover:bg-surface-container-high transition-colors" style="padding: 1rem 1.25rem;">
                    <div class="flex items-center" style="gap: 1rem;">
                        <div class="rounded-full flex items-center justify-center" style="width: 3rem; height: 3rem; flex-shrink: 0; background-color: {{ $tx->category->color }}20; color: {{ $tx->category->color }};">
                            <span class="material-symbols-outlined">{{ $tx->category->icon }}</span>
                        </div>
                        <div>
                            <p class="font-bold text-on-surface text-lg" style="margin: 0;">{{ $tx->category->name }}</p>
                            <p class="text-xs text-on-surface-variant" style="margin: 0.2rem 0 0;">{{ $tx->transaction_date->format('d M Y') }}</p>
                            @if($tx->note)
                                <p class="text-xs text-on-surface-variant" style="margin: 0.1rem 0 0;">{{ $tx->note }}</p>
                            @endif
                        </div>
                    </div>
                    <div style="text-align: right;">
                        @if($tx->type === 'income')
                            <p class="font-bold text-income-green font-display-balance">+ Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        @else
                            <p class="font-bold text-on-surface font-display-balance">- Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </main>
</div>

@include('transactions.partials.form-modal')
@endsection
