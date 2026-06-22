<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyDuit - Duit Lo, Atur Sendiri.')</title>
    <meta name="description" content="@yield('description', 'MyDuit bikin tracking pengeluaran & nabung jadi segampang scroll FYP. Catat transaksi, cek kurs real-time, dan lihat laporan keuangan dalam satu app.')">

    {{--
        Anti-flash script: dijalankan sebelum CSS/body di-render supaya
        tidak ada "flash" putih sebelum dark mode diterapkan.
        Prioritas: localStorage > preferensi sistem (prefers-color-scheme).
    --}}
    <script>
        (function () {
            const saved = localStorage.getItem('myduit-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = saved || (prefersDark ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts: Hanken Grotesk (display), Inter (body), JetBrains Mono (label) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">

    <!-- Material Symbols (ikon) -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-body-base antialiased selection:bg-primary-container selection:text-on-primary-container">
    {{ $slot ?? '' }}
    @yield('content')

    @stack('scripts')
</body>
</html>
