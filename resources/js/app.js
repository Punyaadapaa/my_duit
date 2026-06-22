import './bootstrap';

/**
 * ===== Dark / Light Mode Toggle =====
 * Preferensi disimpan di localStorage dengan key "myduit-theme".
 * Script anti-flash (sebelum render) ada di layout (app.blade.php) <head>.
 */
function initThemeToggle() {
    const toggleButtons = document.querySelectorAll('[data-theme-toggle]');
    const root = document.documentElement;

    const applyTheme = (theme) => {
        if (theme === 'dark') {
            root.classList.add('dark');
        } else {
            root.classList.remove('dark');
        }
        localStorage.setItem('myduit-theme', theme);

        // Sinkronkan ikon/teks pada semua tombol toggle yang ada di halaman
        toggleButtons.forEach((btn) => {
            const iconEl = btn.querySelector('[data-theme-icon]');
            if (iconEl) {
                iconEl.textContent = theme === 'dark' ? 'light_mode' : 'dark_mode';
            }
            btn.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
        });
    };

    const getCurrentTheme = () => (root.classList.contains('dark') ? 'dark' : 'light');

    // Set ikon awal sesuai tema yang sudah diterapkan oleh anti-flash script
    applyTheme(getCurrentTheme());

    toggleButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const next = getCurrentTheme() === 'dark' ? 'light' : 'dark';
            applyTheme(next);
        });
    });
}

document.addEventListener('DOMContentLoaded', initThemeToggle);
