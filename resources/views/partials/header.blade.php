<!-- TopAppBar -->
<header style="position: absolute; top: 0; width: 100%; z-index: 50; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid rgba(203,213,225,0.3); transition: all 0.3s;" class="bg-surface/80 shadow-sm">
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1rem; max-width: 80rem; margin: 0 auto;">
        <!-- Logo -->
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined text-primary" data-weight="fill" style="font-size: 1.5rem;">account_balance_wallet</span>
            <span class="font-display-balance text-primary" style="font-size: 1.5rem; font-weight: 800; letter-spacing: -0.03em; line-height: 1;">MyDuit</span>
        </div>

        <!-- Nav links (desktop) -->
        <nav style="display: none; align-items: center; gap: 1.5rem;" class="md-nav-links">
            <a href="#fitur" class="text-on-surface-variant hover:text-primary transition-colors" style="font-size: 0.875rem; font-weight: 600; text-decoration: none;">Fitur</a>
            <a href="#testimoni" class="text-on-surface-variant hover:text-primary transition-colors" style="font-size: 0.875rem; font-weight: 600; text-decoration: none;">Testimoni</a>
        </nav>

        <!-- Actions -->
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            {{-- Toggle Dark / Light Mode --}}
            <button
                type="button"
                data-theme-toggle
                aria-label="Ganti mode terang/gelap"
                aria-pressed="false"
                class="bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-all cursor-pointer"
                style="width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; border-radius: 9999px; border: 1px solid rgba(203,213,225,0.3);"
            >
                <span class="material-symbols-outlined" style="font-size: 1.25rem;" data-theme-icon>dark_mode</span>
            </button>

            @auth
                <a href="{{ route('dashboard') }}" class="bg-primary text-on-primary hover:bg-primary-fixed-dim transition-all shadow-md" style="padding: 0.5rem 1.5rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-primary text-on-primary hover:bg-primary-fixed-dim transition-all shadow-md" style="padding: 0.5rem 1.5rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                    Join
                </a>
            @endauth
        </div>
    </div>
</header>

<style>
    @media (min-width: 768px) {
        .md-nav-links { display: flex !important; }
        header > div { padding-left: 1.5rem !important; padding-right: 1.5rem !important; }
    }
</style>
