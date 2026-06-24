<!-- Features Bento Grid -->
<section id="fitur" style="max-width: 80rem; margin: 0 auto; padding: 0 1rem; display: flex; flex-direction: column; gap: 3rem;">
    <!-- Section Header -->
    <div style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1rem; max-width: 42rem; margin: 0 auto;">
        <h2 class="text-on-surface" style="font-family: 'Hanken Grotesk', sans-serif; font-size: 1.875rem; line-height: 2.25rem; font-weight: 800; letter-spacing: -0.03em;">
            Fitur Biar Hidup
            <span class="bg-primary-container" style="padding: 0 0.75rem; border-radius: 0.5rem; display: inline-block; transform: rotate(-2deg);">Makin Gampang</span>
        </h2>
        <p class="text-on-surface-variant" style="font-size: 1rem; line-height: 1.5rem;">Semua yang lo butuhin buat tracking duit, kumpul di satu tempat.</p>
    </div>

    <!-- Grid -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;" class="features-grid">

        <!-- Feature 1: Cek Kurs (span 2 kolom di tablet+) -->
        <div class="bg-surface-container-lowest hover:shadow-md transition-shadow feature-kurs" style="border-radius: 1.5rem; padding: 2rem; border: 1px solid rgba(203,213,225,0.3); box-shadow: 0 1px 2px rgba(0,0,0,0.05); position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; min-height: 280px;">
            <!-- Hover gradient -->
            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom right, rgba(var(--c-primary-container), 0.2), transparent); opacity: 0; transition: opacity 0.3s;" class="feature-hover-overlay"></div>

            <div style="position: relative; z-index: 10; display: flex; flex-direction: column; gap: 1rem; max-width: 28rem;">
                <div class="bg-primary-container" style="width: 3rem; height: 3rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined text-primary">currency_exchange</span>
                </div>
                <h3 class="text-on-surface" style="font-size: 1.5rem; line-height: 2rem; font-weight: 700;">Cek Kurs Real-time</h3>
                <p class="text-on-surface-variant" style="font-size: 0.875rem; line-height: 1.25rem;">Nggak usah buka app lain buat cek kurs. Pantau USD to IDR langsung di dashboard.</p>
            </div>

            <!-- Kurs widget -->
            <div class="bg-surface" style="position: relative; z-index: 10; margin-top: 1.5rem; padding: 1rem; border-radius: 1rem; border: 1px solid rgb(var(--c-surface-container-highest)); display: flex; align-items: center; justify-content: space-between; max-width: 24rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span class="material-symbols-outlined text-on-surface-variant" style="font-size: 1.875rem;">payments</span>
                    <div>
                        <p style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em;" class="text-on-surface-variant">1 USD =</p>
                        <p id="live-kurs-value" class="text-on-surface" style="font-size: 1.125rem; font-weight: 600;">Memuat...</p>
                    </div>
                </div>
                <div id="live-kurs-indicator" class="bg-surface-container-highest text-on-surface-variant" style="padding: 0.25rem 0.75rem; border-radius: 9999px; display: flex; align-items: center; gap: 0.25rem;">
                    <span class="material-symbols-outlined" style="font-size: 0.875rem; animation: spin 2s linear infinite;">sync</span>
                    <span style="font-size: 0.75rem; font-weight: 500;">Live</span>
                </div>
            </div>
        </div>

        <!-- Feature 2: Catat Transaksi -->
        <div class="bg-tertiary-container hover:shadow-md transition-shadow" style="border-radius: 1.5rem; padding: 2rem; border: 1px solid rgba(203,213,225,0.2); box-shadow: 0 1px 2px rgba(0,0,0,0.05); position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; min-height: 280px;">
            <!-- Decorative blob -->
            <div style="position: absolute; right: -3rem; bottom: -3rem; width: 12rem; height: 12rem; background: rgba(var(--c-tertiary), 0.1); border-radius: 9999px; filter: blur(40px);"></div>

            <div style="position: relative; z-index: 10; display: flex; flex-direction: column; gap: 1rem;">
                <div class="bg-surface-container-lowest shadow-sm" style="width: 3rem; height: 3rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined text-tertiary">bolt</span>
                </div>
                <h3 class="text-on-surface" style="font-size: 1.5rem; line-height: 2rem; font-weight: 700;">Catat Transaksi Sat-set</h3>
                <p class="text-on-tertiary-container" style="font-size: 0.875rem; line-height: 1.25rem;">Input pengeluaran kilat, kurang dari 5 detik beres. Ga pake ribet.</p>
            </div>

            @auth
            <a href="{{ route('dashboard') }}" class="bg-surface-container-lowest text-on-surface hover:bg-surface transition-colors" style="position: relative; z-index: 10; margin-top: 2rem; width: 100%; padding: 0.75rem; border-radius: 0.75rem; font-weight: 600; font-size: 1.125rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none;">
                <span class="material-symbols-outlined">add</span> Tambah
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-surface-container-lowest text-on-surface hover:bg-surface transition-colors" style="position: relative; z-index: 10; margin-top: 2rem; width: 100%; padding: 0.75rem; border-radius: 0.75rem; font-weight: 600; font-size: 1.125rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none;">
                <span class="material-symbols-outlined">add</span> Tambah
            </a>
            @endauth
        </div>

        <!-- Feature 3: Laporan Detail (full width) -->
        <div class="bg-surface-container-lowest hover:shadow-md transition-shadow feature-laporan" style="border-radius: 1.5rem; padding: 2rem; border: 1px solid rgba(203,213,225,0.3); box-shadow: 0 1px 2px rgba(0,0,0,0.05); position: relative; overflow: hidden; display: flex; flex-direction: column; gap: 2rem; min-height: 280px;">
            <!-- Text -->
            <div style="flex: 1; display: flex; flex-direction: column; gap: 1rem; position: relative; z-index: 10;">
                <div class="bg-secondary-container" style="width: 3rem; height: 3rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                    <span class="material-symbols-outlined text-secondary">pie_chart</span>
                </div>
                <h3 class="text-on-surface" style="font-size: 1.5rem; line-height: 2rem; font-weight: 700;">Laporan Detail &amp; Visual</h3>
                <p class="text-on-surface-variant" style="font-size: 0.875rem; line-height: 1.25rem; max-width: 28rem;">Liat kemana aja duit lo pergi dengan chart yang enak diliat. Evaluasi gampang, dompet aman.</p>
            </div>

            <!-- Chart widget -->
            <div class="bg-surface-container" style="flex: 1; width: 100%; border-radius: 1rem; padding: 1.5rem; border: 1px solid rgb(var(--c-surface-container-highest)); position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem; border-bottom: 1px solid rgb(var(--c-surface-container-highest)); padding-bottom: 1rem;">
                    <div>
                        <p style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em; margin-bottom: 0.25rem;" class="text-on-surface-variant">PENGELUARAN BULAN INI</p>
                        <p class="text-on-surface" style="font-size: 1.5rem; font-weight: 600;">Rp 3.500.000</p>
                    </div>
                    <span class="material-symbols-outlined text-expense-red">trending_down</span>
                </div>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Bar: Makan -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div class="bg-primary-container" style="width: 2rem; height: 2rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined text-primary" style="font-size: 0.875rem;">restaurant</span>
                            </div>
                            <span class="text-on-surface" style="font-size: 0.75rem; font-weight: 500;">Makan</span>
                        </div>
                        <div class="bg-surface-container-highest" style="width: 50%; height: 0.5rem; border-radius: 9999px; overflow: hidden;">
                            <div class="bg-primary" style="height: 100%; width: 60%; border-radius: 9999px;"></div>
                        </div>
                    </div>

                    <!-- Bar: Transport -->
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div class="bg-tertiary-container" style="width: 2rem; height: 2rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined text-tertiary" style="font-size: 0.875rem;">directions_car</span>
                            </div>
                            <span class="text-on-surface" style="font-size: 0.75rem; font-weight: 500;">Transport</span>
                        </div>
                        <div class="bg-surface-container-highest" style="width: 50%; height: 0.5rem; border-radius: 9999px; overflow: hidden;">
                            <div class="bg-tertiary" style="height: 100%; width: 25%; border-radius: 9999px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .feature-kurs:hover .feature-hover-overlay { opacity: 1 !important; }
    @media (min-width: 768px) {
        .features-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }
        .feature-kurs { grid-column: span 2 !important; }
        .feature-laporan {
            grid-column: span 3 !important;
            flex-direction: row !important;
        }
        section#fitur > div:first-child h2 {
            font-size: 2.25rem !important;
            line-height: 2.5rem !important;
        }
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kursValue = document.getElementById('live-kurs-value');
        const indicator = document.getElementById('live-kurs-indicator');

        async function fetchKurs() {
            try {
                // Menggunakan API public dari exchangerate-api
                const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                const idrRate = data.rates.IDR;
                
                if (idrRate) {
                    // Format angka ke format Rupiah
                    kursValue.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(idrRate);
                    
                    // Update indicator ke status berhasil
                    indicator.className = 'bg-income-bg text-income-green';
                    indicator.innerHTML = `
                        <span class="material-symbols-outlined" style="font-size: 0.875rem;">check_circle</span>
                        <span style="font-size: 0.75rem; font-weight: 500;">Updated</span>
                    `;
                }
            } catch (error) {
                console.error('Gagal mengambil data kurs:', error);
                kursValue.textContent = 'Rp 15.000+'; // fallback jika gagal
                indicator.className = 'bg-surface-container-highest text-on-surface-variant';
                indicator.innerHTML = `
                    <span class="material-symbols-outlined" style="font-size: 0.875rem;">error</span>
                    <span style="font-size: 0.75rem; font-weight: 500;">Offline</span>
                `;
            }
        }

        // Fetch kurs langsung saat halaman diload
        fetchKurs();
        
        // Update kurs setiap 5 menit
        setInterval(fetchKurs, 5 * 60 * 1000);
    });
</script>
