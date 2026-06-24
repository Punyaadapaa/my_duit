<!-- CTA Section -->
<section id="testimoni" style="max-width: 80rem; margin: 0 auto; padding: 3rem 1rem 0;">
    <div class="bg-on-surface" style="border-radius: 2.5rem; padding: 3rem 2rem; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 2rem; position: relative; overflow: hidden;">
        <!-- Gradient overlay -->
        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(var(--c-primary), 0.1), transparent);"></div>

        <h2 class="text-surface" style="position: relative; z-index: 10; font-family: 'Hanken Grotesk', sans-serif; font-size: 1.875rem; line-height: 2.25rem; font-weight: 800; letter-spacing: -0.03em; max-width: 32rem;" class="cta-heading">
            Udah Siap Pegang Kendali Duit Lo?
        </h2>

        <p class="text-surface opacity-80" style="position: relative; z-index: 10; font-size: 1.125rem; line-height: 1.75rem; max-width: 28rem;">
            Join sekarang dan rasain gampangnya ngatur keuangan ala anak muda. 100% gratis buat mulai!
        </p>

        @auth
        <a href="{{ route('dashboard') }}" class="bg-primary text-on-primary hover:bg-primary-fixed-dim transition-all shadow-xl" style="position: relative; z-index: 10; padding: 1.25rem 2.5rem; border-radius: 9999px; font-size: 1.125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem;">
            Mulai Sekarang
            <span class="material-symbols-outlined">rocket_launch</span>
        </a>
        @else
        <a href="{{ route('login') }}" class="bg-primary text-on-primary hover:bg-primary-fixed-dim transition-all shadow-xl" style="position: relative; z-index: 10; padding: 1.25rem 2.5rem; border-radius: 9999px; font-size: 1.125rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.75rem;">
            Mulai Sekarang
            <span class="material-symbols-outlined">rocket_launch</span>
        </a>
        @endauth
    </div>
</section>

<style>
    @media (min-width: 768px) {
        #testimoni > div {
            padding: 4rem 3rem !important;
        }
        #testimoni h2 {
            font-size: 3rem !important;
            line-height: 3.5rem !important;
        }
    }
</style>
