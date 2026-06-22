<!-- Footer -->
<footer class="bg-surface-container" style="width: 100%; padding: 3rem 0; margin-top: 6rem;">
    <div style="display: flex; flex-direction: column; justify-content: space-between; align-items: center; gap: 1.5rem; padding: 0 1rem; max-width: 80rem; margin: 0 auto;">
        <!-- Logo -->
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span class="material-symbols-outlined text-on-surface">account_balance_wallet</span>
            <span class="text-on-surface" style="font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.05em;">MYDUIT</span>
        </div>

        <!-- Links -->
        <nav style="display: flex; gap: 1.5rem;">
            <a href="#" class="text-slate-muted hover:text-primary transition-colors" style="font-size: 0.875rem; text-decoration: none; opacity: 0.8;">Privacy</a>
            <a href="#" class="text-slate-muted hover:text-primary transition-colors" style="font-size: 0.875rem; text-decoration: none; opacity: 0.8;">Terms</a>
            <a href="#" class="text-slate-muted hover:text-primary transition-colors" style="font-size: 0.875rem; text-decoration: none; opacity: 0.8;">Twitter</a>
            <a href="#" class="text-slate-muted hover:text-primary transition-colors" style="font-size: 0.875rem; text-decoration: none; opacity: 0.8;">Instagram</a>
        </nav>

        <!-- Copyright -->
        <p class="text-secondary" style="font-size: 0.875rem;">
            &copy; {{ date('Y') }} MyDuit. All rights reserved.
        </p>
    </div>
</footer>

<style>
    @media (min-width: 768px) {
        footer > div {
            flex-direction: row !important;
            padding: 0 1.5rem !important;
        }
    }
</style>
