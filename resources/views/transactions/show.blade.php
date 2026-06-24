@extends('layouts.app')

@section('title', 'Detail Transaksi - MyDuit')

@section('content')
<div class="min-h-screen bg-surface flex flex-col relative">
    <!-- Navbar -->
    <header class="bg-surface-container-low border-b border-outline-variant/30 relative z-40">
        <div class="max-w-5xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('transactions.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h1 class="text-xl font-bold font-display-balance text-on-surface tracking-tight">Detail Transaksi</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <button type="button" data-theme-toggle aria-label="Ganti mode terang/gelap" class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container text-on-surface hover:bg-surface-container-highest transition-all border border-outline-variant/30 cursor-pointer">
                    <span class="material-symbols-outlined text-xl" data-theme-icon>dark_mode</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 md:px-8 py-8 relative z-10 opacity-0" style="animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
        
        @if(session('success'))
        <div class="mb-6 bg-income-bg text-income-green p-4 rounded-xl text-sm border border-income-green/30 flex items-center gap-2 shadow-sm" style="animation: popIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;">
            <span class="material-symbols-outlined text-xl">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[0.9fr_1.1fr] lg:items-start">
            <!-- Receipt Summary -->
            <section class="bg-surface-container-low rounded-3xl border border-outline-variant/30 overflow-hidden shadow-sm relative transition-all duration-300 lg:sticky lg:top-28">
                <div class="p-6 md:p-8 lg:p-10 relative z-10 flex flex-col items-center text-center">
                    <div class="inline-flex items-center justify-center rounded-full w-20 h-20 mb-5 shadow-inner" style="background-color: {{ $transaction->category->color }}20; color: {{ $transaction->category->color }};">
                        <span class="material-symbols-outlined text-4xl">{{ $transaction->category->icon }}</span>
                    </div>

                    <p class="font-bold text-on-surface text-xl mb-3">{{ $transaction->category->name }}</p>

                    @if($transaction->type === 'income')
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-income-green font-display-balance tracking-tight mb-5 break-words">
                            + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </h2>
                        <div class="bg-income-bg text-income-green text-sm font-semibold px-4 py-1.5 rounded-full flex items-center gap-1.5">
                            <span class="material-symbols-outlined" style="font-size: 16px;">verified</span>
                            Pemasukan Berhasil
                        </div>
                    @else
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-on-surface font-display-balance tracking-tight mb-5 break-words">
                            - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </h2>
                        <div class="bg-surface-container-highest text-on-surface-variant text-sm font-semibold px-4 py-1.5 rounded-full flex items-center gap-1.5">
                            <span class="material-symbols-outlined" style="font-size: 16px;">verified</span>
                            Pengeluaran Berhasil
                        </div>
                    @endif
                </div>
            </section>

            <section class="flex flex-col gap-6">
                <!-- Details Info -->
                <div class="bg-surface-container-low rounded-3xl border border-outline-variant/30 overflow-hidden shadow-sm p-5 md:p-6 lg:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-surface-container p-4 border border-outline-variant/20">
                            <div class="flex items-center gap-3 text-on-surface-variant mb-3">
                                <span class="material-symbols-outlined opacity-70" style="font-size: 20px;">event</span>
                                <span class="text-sm font-medium">Tanggal Transaksi</span>
                            </div>
                            <span class="text-lg font-bold font-display-balance text-on-surface">{{ $transaction->transaction_date->format('d M Y') }}</span>
                        </div>

                        <div class="rounded-2xl bg-surface-container p-4 border border-outline-variant/20">
                            <div class="flex items-center gap-3 text-on-surface-variant mb-3">
                                <span class="material-symbols-outlined opacity-70" style="font-size: 20px;">wallet</span>
                                <span class="text-sm font-medium">Metode / Dompet</span>
                            </div>
                            <span class="text-lg font-bold text-on-surface">{{ $transaction->wallet->name ?? 'Dompet Utama' }}</span>
                        </div>

                        <div class="rounded-2xl bg-surface-container p-4 border border-outline-variant/20 md:col-span-2">
                            <div class="flex items-center gap-3 text-on-surface-variant mb-3">
                                <span class="material-symbols-outlined opacity-70" style="font-size: 20px;">schedule</span>
                                <span class="text-sm font-medium">Waktu Pencatatan</span>
                            </div>
                            <span class="text-lg font-bold font-display-balance text-on-surface">{{ $transaction->created_at->format('H:i - d M Y') }}</span>
                        </div>
                    </div>

                    @if($transaction->note)
                    <div class="mt-5">
                        <div class="flex items-center gap-3 text-on-surface-variant mb-3">
                            <span class="material-symbols-outlined opacity-70" style="font-size: 20px;">notes</span>
                            <span class="text-sm font-medium">Catatan Tambahan</span>
                        </div>
                        <div class="bg-surface-container p-4 rounded-2xl border border-outline-variant/20">
                            <p class="text-on-surface text-sm md:text-base leading-relaxed">{{ $transaction->note }}</p>
                        </div>
                    </div>
                    @endif

                    @if($transaction->image_path)
                    <div class="mt-5">
                        <div class="flex items-center gap-3 text-on-surface-variant mb-3">
                            <span class="material-symbols-outlined opacity-70" style="font-size: 20px;">image</span>
                            <span class="text-sm font-medium">Bukti Transaksi</span>
                        </div>
                        <div class="bg-surface-container rounded-2xl border border-outline-variant/20 overflow-hidden flex items-center justify-center p-3">
                            <img src="{{ Storage::url($transaction->image_path) }}" alt="Bukti Transaksi" class="w-full h-auto object-contain max-h-80 rounded-xl">
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button onclick="window.openTransactionModal('{{ $transaction->type }}', {{ $transaction->toJson() }})" class="w-full bg-surface-container-low text-on-surface border border-outline-variant/30 font-semibold rounded-xl flex items-center justify-center gap-2 hover:bg-surface-container-high transition-all shadow-sm py-3 cursor-pointer">
                        <span class="material-symbols-outlined" style="font-size: 20px;">edit_square</span>
                        Ubah Transaksi
                    </button>

                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini? Saldo akan disesuaikan otomatis.');" class="w-full m-0 p-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white dark:bg-red-500/20 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white font-semibold rounded-xl flex items-center justify-center gap-2 transition-all shadow-sm py-3 cursor-pointer border border-transparent">
                            <span class="material-symbols-outlined" style="font-size: 20px;">delete</span>
                            Hapus
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes popIn {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>

@include('transactions.partials.form-modal')
@endsection
