@props(['tx'])

<div class="flex flex-col sm:flex-row sm:items-center justify-between hover:bg-surface-container-high transition-colors group" style="padding: 1.25rem; gap: 1rem;">
    <div class="flex items-center" style="gap: 1rem;">
        <div class="rounded-full flex items-center justify-center" style="width: 3.5rem; height: 3.5rem; flex-shrink: 0; background-color: {{ $tx->category->color }}20; color: {{ $tx->category->color }};">
            <span class="material-symbols-outlined" style="font-size: 1.75rem;">{{ $tx->category->icon }}</span>
        </div>
        <div>
            <p class="font-bold text-on-surface text-lg" style="margin: 0; line-height: 1.2;">{{ $tx->category->name }}</p>
            <p class="text-xs font-medium font-display-balance text-on-surface-variant mt-1">{{ $tx->transaction_date->format('d M Y') }}</p>
            @if($tx->note)
                <p class="text-xs text-on-surface-variant mt-0.5 line-clamp-1 italic">"{{ $tx->note }}"</p>
            @endif
        </div>
    </div>
    
    <div class="flex items-center" style="justify-content: space-between; gap: 1rem;">
        <div style="text-align: right;">
            @if($tx->type === 'income')
                <p class="font-extrabold text-income-green font-display-balance text-xl">+ Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
            @else
                <p class="font-extrabold text-on-surface font-display-balance text-xl">- Rp {{ number_format($tx->amount, 0, ',', '.') }}</p>
            @endif
        </div>
        
        <div class="flex items-center group-hover:opacity-100 opacity-0 transform group-hover:translate-x-0 translate-x-2 transition-all duration-300" style="gap: 0.35rem; flex-shrink: 0;">
            <a href="{{ route('transactions.show', $tx->id) }}" class="flex items-center justify-center rounded-xl bg-surface-container hover:bg-primary hover:text-on-primary text-on-surface-variant transition-all shadow-sm cursor-pointer" style="width: 2.75rem; height: 2.75rem;" title="Detail">
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">visibility</span>
            </a>
            <button onclick="window.openTransactionModal('{{ $tx->type }}', {{ $tx->toJson() }})" class="flex items-center justify-center rounded-xl bg-surface-container hover:bg-primary hover:text-on-primary text-on-surface-variant transition-all shadow-sm cursor-pointer" style="width: 2.75rem; height: 2.75rem;" title="Edit">
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">edit</span>
            </button>
            <form action="{{ route('transactions.destroy', $tx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini? Saldo akan disesuaikan otomatis.');" style="margin: 0; padding: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center justify-center rounded-xl bg-surface-container hover:bg-error hover:text-on-error text-on-surface-variant transition-all shadow-sm cursor-pointer border border-transparent hover:border-error" style="width: 2.75rem; height: 2.75rem;" title="Hapus">
                    <span class="material-symbols-outlined" style="font-size: 1.25rem;">delete</span>
                </button>
            </form>
        </div>
    </div>
</div>
