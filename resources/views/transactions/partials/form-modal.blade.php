<!-- Transaction Modal -->
<div id="transactionModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-md transition-opacity duration-300" style="display: none; opacity: 0;">
    <div class="bg-surface w-full max-w-lg rounded-3xl overflow-hidden shadow-2xl scale-95 transition-transform duration-300 border border-white/10" id="transactionModalContent">
        <div class="bg-surface-container-low border-b border-outline-variant/20 px-8 py-5 flex items-center justify-between">
            <h2 id="modalTitle" class="text-2xl font-bold font-display-balance text-on-surface tracking-tight">Tambah Transaksi</h2>
            <button type="button" onclick="window.closeTransactionModal()" class="w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-highest transition-colors">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>
        
        <form id="transactionForm" method="POST" action="{{ old('transaction_id') ? route('transactions.update', old('transaction_id')) : route('transactions.store') }}" class="p-8 flex flex-col gap-5" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="{{ old('_method', 'POST') }}">
            <input type="hidden" name="transaction_id" id="transactionId" value="{{ old('transaction_id') }}">
            <input type="hidden" name="type" id="transactionType" value="{{ old('type', 'expense') }}">
            
            @if ($errors->any())
                <div class="bg-error-container/80 text-on-error-container p-4 rounded-2xl text-sm mb-2 border border-error/30 backdrop-blur-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const isEdit = "{{ old('transaction_id') }}" !== "";
                        if (isEdit) {
                            window.openTransactionModal('{{ old("type", "expense") }}', {
                                id: "{{ old('transaction_id') }}",
                                type: "{{ old('type') }}",
                                amount: "{{ old('amount') }}",
                                transaction_date: "{{ old('transaction_date') }}",
                                note: "{{ old('note') }}",
                                category_id: "{{ old('category_id') }}"
                            });
                        } else {
                            window.openTransactionModal('{{ old("type", "expense") }}');
                        }
                    });
                </script>
            @endif

            <!-- Segmented Control for Type -->
            <div class="flex p-1 bg-surface-container-high rounded-2xl mb-2 relative z-0">
                <button type="button" id="btnExpense" onclick="window.setTransactionType('expense')" class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 z-10 text-on-surface shadow-sm bg-surface">Pengeluaran</button>
                <button type="button" id="btnIncome" onclick="window.setTransactionType('income')" class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all duration-200 z-10 text-on-surface-variant hover:text-on-surface">Pemasukan</button>
            </div>

            <!-- Amount Input -->
            <div>
                <label for="amount" class="text-xs uppercase tracking-wider font-bold text-on-surface-variant block mb-2">Nominal</label>
                <div class="relative flex items-center">
                    <span class="absolute left-5 text-xl font-bold text-on-surface-variant font-display-balance">Rp</span>
                    <input type="number" id="amount" name="amount" required min="1" step="1"
                        class="w-full bg-surface-container-low text-3xl font-extrabold font-display-balance text-on-surface border border-outline-variant/50 rounded-2xl pl-14 pr-5 py-4 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all shadow-inner"
                        placeholder="0" value="{{ old('amount') }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Category Input -->
                <div>
                    <label for="category_id" class="text-xs uppercase tracking-wider font-bold text-on-surface-variant block mb-2">Kategori</label>
                    <div class="relative">
                        <select id="category_id" name="category_id" required
                            class="w-full bg-surface-container-low text-on-surface font-medium border border-outline-variant/50 rounded-2xl pl-4 pr-10 py-3 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all appearance-none cursor-pointer" data-old="{{ old('category_id') }}">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-type="{{ $category->type }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                    </div>
                </div>

                <!-- Date Input -->
                <div>
                    <label for="transaction_date" class="text-xs uppercase tracking-wider font-bold text-on-surface-variant block mb-2">Tanggal & Waktu</label>
                    <input type="datetime-local" id="transaction_date" name="transaction_date" required value="{{ old('transaction_date', date('Y-m-d\TH:i')) }}"
                        class="w-full bg-surface-container-low text-on-surface font-medium font-display-balance border border-outline-variant/50 rounded-2xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all cursor-pointer">
                </div>
            </div>

            <!-- Note Input -->
            <div>
                <label for="note" class="text-xs uppercase tracking-wider font-bold text-on-surface-variant block mb-2">Catatan <span class="font-normal opacity-70">(Opsional)</span></label>
                <input type="text" id="note" name="note"
                    class="w-full bg-surface-container-low text-on-surface border border-outline-variant/50 rounded-2xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                    placeholder="Misal: Beli kopi susu" value="{{ old('note') }}">
            </div>

            <!-- Image Input -->
            <div>
                <label for="image" class="text-xs uppercase tracking-wider font-bold text-on-surface-variant block mb-2">Bukti Transaksi <span class="font-normal opacity-70">(Opsional, Max 5MB)</span></label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="w-full bg-surface-container-low text-on-surface border border-outline-variant/50 rounded-2xl px-4 py-3 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-on-primary hover:file:bg-primary-fixed-dim cursor-pointer text-sm">
            </div>

            <button type="submit" id="submitBtn" class="w-full mt-2 bg-primary text-on-primary py-4 rounded-2xl font-bold text-lg hover:bg-primary-fixed-dim hover:-translate-y-0.5 active:translate-y-0 transition-all shadow-lg hover:shadow-primary/25">
                Simpan Transaksi
            </button>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('transactionModal');
    const modalContent = document.getElementById('transactionModalContent');
    const form = document.getElementById('transactionForm');
    const formMethod = document.getElementById('formMethod');
    const modalTitle = document.getElementById('modalTitle');
    const typeInput = document.getElementById('transactionType');
    const btnExpense = document.getElementById('btnExpense');
    const btnIncome = document.getElementById('btnIncome');
    const categorySelect = document.getElementById('category_id');

    // Filter kategori berdasarkan tipe yang dipilih
    window.filterCategories = function(type) {
        let hasVisibleOption = false;
        let firstVisibleValue = '';
        
        Array.from(categorySelect.options).forEach(option => {
            if (option.value === "") return; // Skip placeholder
            
            if (option.getAttribute('data-type') === type) {
                option.style.display = '';
                if (!hasVisibleOption) {
                    firstVisibleValue = option.value;
                    hasVisibleOption = true;
                }
            } else {
                option.style.display = 'none';
            }
        });

        // Auto select
        if (hasVisibleOption) {
            let oldCat = categorySelect.getAttribute('data-old');
            if (oldCat && categorySelect.querySelector(`option[value="${oldCat}"][data-type="${type}"]`)) {
                categorySelect.value = oldCat;
            } else {
                categorySelect.value = firstVisibleValue;
            }
        } else {
            categorySelect.value = '';
        }
    };

    window.setTransactionType = function(type) {
        typeInput.value = type;
        if (type === 'income') {
            btnIncome.className = 'flex-1 py-2 text-sm font-semibold rounded-lg bg-surface text-on-surface shadow-sm transition-all border border-outline-variant/30';
            btnExpense.className = 'flex-1 py-2 text-sm font-semibold rounded-lg text-on-surface-variant hover:text-on-surface transition-all border border-transparent';
        } else {
            btnExpense.className = 'flex-1 py-2 text-sm font-semibold rounded-lg bg-surface text-on-surface shadow-sm transition-all border border-outline-variant/30';
            btnIncome.className = 'flex-1 py-2 text-sm font-semibold rounded-lg text-on-surface-variant hover:text-on-surface transition-all border border-transparent';
        }
        window.filterCategories(type);
    };

    window.openTransactionModal = function(type = 'expense', transactionData = null) {
        // Setup Form Action & Method
        if (transactionData) {
            modalTitle.innerText = 'Edit Transaksi';
            formMethod.value = 'PUT';
            form.action = `/transactions/${transactionData.id}`;
            document.getElementById('transactionId').value = transactionData.id;
            
            document.getElementById('amount').value = Math.round(transactionData.amount);
            
            // Format datetime returned by eloquent (e.g. 2024-01-01T15:30:00.000000Z or 2024-01-01 15:30:00) 
            // into datetime-local format YYYY-MM-DDTHH:MM
            let formattedDate = transactionData.transaction_date;
            if (formattedDate.includes('T')) {
                formattedDate = formattedDate.substring(0, 16);
            } else if (formattedDate.includes(' ')) {
                formattedDate = formattedDate.replace(' ', 'T').substring(0, 16);
            }
            document.getElementById('transaction_date').value = formattedDate;
            
            document.getElementById('note').value = transactionData.note || '';
            
            setTransactionType(transactionData.type);
            
            // Timeout to allow DOM updates for option display
            setTimeout(() => {
                categorySelect.value = transactionData.category_id;
            }, 10);
            
            document.getElementById('submitBtn').innerText = 'Simpan Perubahan';
        } else {
            modalTitle.innerText = 'Tambah Transaksi';
            formMethod.value = 'POST';
            form.action = '{{ route("transactions.store") }}';
            document.getElementById('transactionId').value = '';
            
            form.reset();
            // Optional: reset selects if needed, form.reset() handles most
            setTransactionType(type);
            
            document.getElementById('submitBtn').innerText = 'Simpan Transaksi';
        }

        // Show Modal
        modal.style.display = 'flex';
        // Force reflow for animation
        void modal.offsetWidth;
        modal.style.opacity = '1';
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    };

    window.closeTransactionModal = function() {
        modal.style.opacity = '0';
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300); // Wait for transition
    };

    // Close on click outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            window.closeTransactionModal();
        }
    });
</script>
