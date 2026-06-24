@extends('layouts.app')

@section('title', 'Riwayat Transaksi - MyDuit')

@section('content')
<div class="min-h-screen bg-surface flex flex-col relative">
    <!-- Navbar -->
    <header class="bg-surface-container-low border-b border-outline-variant/20 relative z-40 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all">
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

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-on-surface mb-1 font-display-balance">Semua Catatan</h2>
                <p class="text-on-surface-variant text-sm">Pantau arus kas lo secara detail di sini.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                <form action="{{ route('transactions.index') }}" method="GET" class="w-full sm:w-auto">
                    <label for="transaction-search" class="sr-only">Cari kategori atau catatan</label>
                    <div class="transaction-search relative flex h-14 w-full sm:w-80 md:w-96 items-center overflow-hidden rounded-2xl border border-outline-variant/40 bg-surface-container-low shadow-sm transition-all duration-200 focus-within:border-primary focus-within:ring-2 focus-within:ring-primary/20">
                        <input
                            id="transaction-search"
                            type="search"
                            name="search"
                            class="h-full min-w-0 flex-1 appearance-none border-0 bg-transparent px-5 text-base font-medium text-on-surface outline-none transition-colors placeholder:text-on-surface-variant/70 focus:border-0 focus:outline-none focus:ring-0"
                            placeholder="Cari kategori atau catatan..."
                            value="{{ request('search') }}"
                        >

                        @if(request('search'))
                            <a href="{{ route('transactions.index') }}" class="mr-1 flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl text-on-surface-variant transition-colors hover:bg-surface-container-high hover:text-on-surface focus:outline-none focus:ring-2 focus:ring-primary/20" title="Hapus pencarian" aria-label="Hapus pencarian">
                                <span class="material-symbols-outlined" style="font-size: 18px;">close</span>
                            </a>
                        @endif

                        <button type="submit" class="mr-1.5 flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-outline-variant/30 bg-surface-container text-on-surface-variant transition-colors hover:bg-primary hover:text-on-primary focus:outline-none focus:ring-2 focus:ring-primary/20" aria-label="Cari">
                            <span class="material-symbols-outlined" style="font-size: 22px;">search</span>
                        </button>
                    </div>
                </form>
                
                <button onclick="window.openTransactionModal('expense')" class="bg-primary text-on-primary font-bold rounded-2xl flex items-center justify-center gap-2 hover:bg-primary-fixed-dim transition-all shadow-md cursor-pointer w-full sm:w-auto whitespace-nowrap" style="padding: 0.75rem 1.5rem;">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Tambah Transaksi
                </button>
            </div>
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
                    <x-transaction-card :tx="$tx" />
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
