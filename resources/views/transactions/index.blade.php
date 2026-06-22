@extends('layouts.app')

@section('title', 'Riwayat Transaksi - MyDuit')

@section('content')
<div class="min-h-screen bg-surface flex flex-col relative">
    <!-- Navbar -->
    <header class="bg-surface-container-low border-b border-outline-variant/20 relative z-40 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all hover:-translate-x-1">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="text-xl font-bold font-display-balance text-on-surface tracking-tight">Riwayat Transaksi</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <button type="button" data-theme-toggle aria-label="Ganti mode terang/gelap" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container text-on-surface hover:bg-surface-container-highest transition-all border border-outline-variant/30 cursor-pointer">
                    <span class="material-symbols-outlined text-xl" data-theme-icon>dark_mode</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 md:px-8 py-8 relative z-10">
        @if(session('success'))
        <div class="mb-6 bg-income-bg/80 backdrop-blur-md text-income-green p-4 rounded-2xl text-sm border border-income-green/30 flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined text-xl">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-on-surface mb-1 font-display-balance">Semua Catatan</h2>
                <p class="text-on-surface-variant text-sm">Pantau arus kas lo secara detail di sini.</p>
            </div>
            <button onclick="window.openTransactionModal('expense')" class="bg-primary text-on-primary font-bold rounded-2xl flex items-center justify-center gap-2 hover:bg-primary-fixed-dim transition-all shadow-md cursor-pointer" style="padding: 0.75rem 1.5rem;">
                <span class="material-symbols-outlined text-xl">add</span>
                Tambah Transaksi
            </button>
        </div>

        @if($transactions->isEmpty())
        <div class="bg-surface-container-low rounded-3xl p-16 border border-outline-variant/20 text-center shadow-sm">
            <div class="w-24 h-24 bg-surface-container-high rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant opacity-50">receipt_long</span>
            </div>
            <h3 class="text-xl font-bold text-on-surface mb-2 font-display-balance">Belum ada transaksi</h3>
            <p class="text-on-surface-variant max-w-md mx-auto">Mulai catat pengeluaran atau pemasukan pertama lo untuk melihat riwayatnya di sini.</p>
        </div>
        @else
        <div class="bg-surface-container-low rounded-3xl border border-outline-variant/20 overflow-hidden shadow-sm">
            <div class="flex flex-col divide-y divide-outline-variant/10">
                @foreach($transactions as $tx)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between hover:bg-surface-container-high transition-colors group" style="padding: 1.25rem; gap: 1rem;">
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
                    
                    <div class="flex items-center" style="justify-content: space-between; gap: 1rem;">
                        <div style="text-align: right;">
                            @if($tx->type === 'income')
                                <p class="font-extrabold text-income-green font-display-balance text-lg">+ Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                            @else
                                <p class="font-extrabold text-on-surface font-display-balance text-lg">- Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
                            @endif
                        </div>
                        
                        <div class="flex items-center" style="gap: 0.25rem; flex-shrink: 0;">
                            <button onclick="window.openTransactionModal('{{ $tx->type }}', {{ $tx->toJson() }})" class="flex items-center justify-center rounded-xl bg-surface-container hover:bg-primary/10 text-on-surface-variant hover:text-primary transition-colors cursor-pointer" style="width: 2.5rem; height: 2.5rem;" title="Edit">
                                <span class="material-symbols-outlined" style="font-size: 1.25rem;">edit</span>
                            </button>
                            <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini? Saldo akan disesuaikan otomatis.');" style="margin: 0; padding: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center rounded-xl bg-surface-container hover:bg-error-container text-on-surface-variant hover:text-error transition-colors cursor-pointer" style="width: 2.5rem; height: 2.5rem;" title="Hapus">
                                    <span class="material-symbols-outlined" style="font-size: 1.25rem;">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="mt-8">
            {{ $transactions->links() }}
        </div>
        @endif
    </main>
</div>

@include('transactions.partials.form-modal')
@endsection
