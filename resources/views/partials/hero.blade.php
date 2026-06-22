<!-- Hero Section -->
<section style="max-width: 80rem; margin: 0 auto; padding: 4rem 1rem 0; display: flex; flex-direction: column; align-items: center; gap: 3rem;">
    <!-- Text Content -->
    <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 2rem; position: relative; z-index: 10; flex: 1; width: 100%;" class="hero-text">
        <!-- Badge -->
        <div class="bg-primary-container text-on-primary-container" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 9999px; border: 1px solid rgba(203,213,225,0.3); font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em;">
            <span class="bg-primary" style="width: 0.5rem; height: 0.5rem; border-radius: 9999px; animation: pulse 2s infinite;"></span>
            MANAGE DUIT LIKE A PRO
        </div>

        <!-- Heading -->
        <h1 class="text-on-surface" style="font-family: 'Hanken Grotesk', sans-serif; font-size: 2.25rem; line-height: 2.75rem; font-weight: 800; letter-spacing: -0.03em; max-width: 42rem;">
            Duit Lo,<br>
            <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, rgb(var(--c-primary)), rgb(var(--c-tertiary))); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Atur Sendiri.</span>
        </h1>

        <!-- Description -->
        <p class="text-on-surface-variant" style="font-size: 1rem; line-height: 1.5rem; max-width: 32rem;">
            Gak usah pusing mikirin cashflow. MyDuit bikin tracking pengeluaran &amp; nabung jadi segampang scroll FYP. Bye-bye boncos, hello dompet tebel!
        </p>

        <!-- CTA Buttons -->
        <div style="display: flex; flex-direction: column; gap: 1rem; width: 100%; margin-top: 0.5rem;" class="hero-buttons">
            @auth
            <a href="{{ route('dashboard') }}" class="bg-on-surface text-surface hover:opacity-90 transition-all shadow-lg" style="padding: 1rem 2rem; border-radius: 9999px; font-weight: 600; font-size: 1.125rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;">
                Mulai Sekarang
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">arrow_forward</span>
            </a>
            @else
            <a href="{{ route('login') }}" class="bg-on-surface text-surface hover:opacity-90 transition-all shadow-lg" style="padding: 1rem 2rem; border-radius: 9999px; font-weight: 600; font-size: 1.125rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;">
                Mulai Sekarang
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">arrow_forward</span>
            </a>
            @endauth
            <a href="https://youtube.com/shorts/Nwd1c7u_pr4?si=-kosVDeO3I8q7WCv" target="_blank" class="bg-surface-container-highest text-on-surface hover:opacity-80 transition-all shadow-sm" style="padding: 1rem 2rem; border-radius: 9999px; font-weight: 600; font-size: 1.125rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; border: 1px solid rgba(203,213,225,0.2);">
                <span class="material-symbols-outlined" style="font-size: 1.25rem;">play_circle</span>
                Liat Demo
            </a>
        </div>
    </div>

    <!-- Mockup -->
    <div style="position: relative; width: 100%; max-width: 20rem; margin: 0 auto; display: flex; justify-content: center;" class="hero-mockup">
        <!-- Glow -->
        <div style="position: absolute; inset: -1rem; border-radius: 9999px; filter: blur(48px); opacity: 0.6; background: linear-gradient(to top right, rgba(var(--c-primary), 0.2), rgba(var(--c-tertiary), 0.2));"></div>

        <!-- Phone frame -->
        <div class="bg-surface-container-lowest" style="position: relative; border-radius: 2.5rem; border: 8px solid rgb(var(--c-surface-container-highest)); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; width: 100%; max-width: 320px; transform: rotate(-2deg); transition: transform 0.5s;">
            <img
                src="{{ asset('images/hero-mockup.svg') }}"
                alt="Mockup aplikasi MyDuit menampilkan dashboard saldo dan transaksi terbaru di layar smartphone."
                style="width: 100%; height: auto; display: block;"
            >
        </div>

        <!-- Floating card -->
        <div class="bg-surface-container-lowest shadow-xl" style="position: absolute; top: 25%; right: -2rem; padding: 0.75rem; border-radius: 1rem; border: 1px solid rgba(203,213,225,0.1); display: flex; align-items: center; gap: 0.75rem; animation: bounce 3s infinite;">
            <div class="bg-income-bg" style="padding: 0.5rem; border-radius: 9999px;">
                <span class="material-symbols-outlined text-income-green">trending_up</span>
            </div>
            <div>
                <p class="text-on-surface-variant" style="font-size: 0.75rem; font-weight: 500;">Pemasukan</p>
                <p class="text-on-surface" style="font-size: 0.875rem; font-weight: 600;">+Rp 500k</p>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    @media (min-width: 768px) {
        .hero-text h1 {
            font-size: 3.5rem !important;
            line-height: 4rem !important;
        }
    }
    @media (min-width: 1024px) {
        .hero-text h1 {
            font-size: 3.5rem !important;
            line-height: 4rem !important;
        }
        section:has(.hero-text) {
            flex-direction: row !important;
            padding-top: 6rem !important;
            gap: 3rem !important;
        }
        .hero-buttons {
            flex-direction: row !important;
            width: auto !important;
        }
        .hero-mockup {
            margin: 0 !important;
            max-width: 24rem !important;
        }
    }
</style>
