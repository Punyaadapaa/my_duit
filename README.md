# 💰 MyDuit - Personal Finance Tracker

**MyDuit** adalah aplikasi berbasis web cerdas yang dirancang untuk membantu Anda memantau, mencatat, dan mengelola arus kas pribadi (pemasukan dan pengeluaran) secara mudah, efisien, dan modern. 

Dibangun dengan antarmuka yang sangat responsif, _clean_, dan mendukung penuh peralihan tema Terang/Gelap (_Light/Dark Mode_), MyDuit menghadirkan pengalaman pencatatan keuangan premium layaknya aplikasi _mobile_ langsung di _browser_ Anda.

---

## 🌟 Fitur Unggulan

### 1. 🚀 Desain UI/UX Premium & Adaptif
- **Glassmorphism & Micro-animations:** Menggunakan palet warna modern, bayangan transparan, dan animasi _pulse/bounce_ yang hidup.
- **Responsif Penuh:** Tata letak (_layout_) beradaptasi secara mulus; mulai dari tampilan ringkas di layar HP hingga tata letak layar lebar di tablet dan desktop.
- **Dark Mode Alami:** Secara otomatis menyesuaikan komponen UI (termasuk ikon dan bar pencarian) agar kontras tetap nyaman di mata saat layar dalam mode gelap.

### 2. 🔐 Autentikasi Cepat & Auto-Wallet
- **Custom Auth System:** Sistem login dan registrasi berjalan sangat ringan dan bebas dari dependensi yang berat.
- **Generasi Dompet Otomatis:** Saat pengguna baru selesai mendaftar, sistem otomatis membuatkan entitas "Dompet Utama" dengan saldo awal Rp 0, sehingga siap digunakan.

### 3. 📊 Dashboard Pintar
- **Ringkasan Real-Time:** Menghitung "Total Pemasukan" dan "Total Pengeluaran" bulan berjalan secara akurat.
- **Daftar Riwayat Rapi:** Desain riwayat transaksi mengadopsi standar _finance_ modern (warna _income/expense_ khusus, ringkasan catatan, dan label waktu).

### 4. 💸 Manajemen Transaksi Fleksibel
- **Modal Interaktif (Tanpa Reload):** Menambah atau mengedit transaksi dilakukan melalui jendela _pop-up_ (Modal) elegan tanpa perlu berpindah halaman.
- **Kategori Adaptif:** Pilihan kategori akan otomatis berubah sesuai dengan jenis transaksi (Pemasukan/Pengeluaran).
- **Upload Bukti Transaksi (Baru!):** Pengguna dapat melampirkan foto bukti transaksi atau kuitansi (Maksimal 5MB). File lama otomatis dibersihkan saat file diperbarui atau transaksi dihapus.

### 5. 🧠 Logika Saldo Anti-Lag
Aplikasi menggunakan sistem "Model Observers" di tingkat `Transaction`. Saldo akan selalu sinkron secara otomatis:
- **Otomatis bertambah/berkurang** saat ada transaksi baru.
- **Rollback otomatis** jika transaksi dibatalkan atau dihapus.
- **Hitung selisih presisi** saat mengedit nominal transaksi tanpa merusak saldo total.

---

## 💻 Teknologi yang Digunakan

Aplikasi MyDuit mengombinasikan _backend_ yang solid dengan pendekatan _frontend_ yang gesit:

- **Backend:** Laravel 10 (PHP ^8.1)
- **Frontend Engine:** Blade Templating Engine (HTML5)
- **Styling:** Tailwind CSS (dengan Vanilla CSS untuk variabel _theme_ dan _smooth transitions_)
- **Database:** MySQL / SQLite
- **Interaktivitas:** Vanilla JavaScript murni 

---

## 🚀 Cara Menjalankan Project (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan MyDuit di komputer Anda:

1. **Persiapan:** Pastikan Anda telah menginstal PHP >= 8.1, Composer, Node.js, dan database MySQL (seperti Laragon, XAMPP, atau Laravel Herd).
2. **Kloning Repositori & Install Dependencies:**
    ```bash
    composer install
    npm install
    ```
3. **Konfigurasi Environment:**
   Duplikat file `.env.example` menjadi `.env` dan sesuaikan kredensial database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_MyDuit
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. **Jalankan Migrasi & Seeder Database:**
   Perintah ini akan membuat semua struktur tabel dan mengisi data kategori bawaan.
    ```bash
    php artisan migrate:fresh --seed
    ```
5. **Aktivasi Storage Link (Wajib):**
   Wajib dijalankan agar lampiran gambar (bukti transaksi) bisa diakses di browser:
    ```bash
    php artisan storage:link
    ```
6. **Kompilasi Aset CSS & JS:**
    ```bash
    npm run build
    # Atau 'npm run dev' jika ingin memodifikasi tampilan live
    ```
7. **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```
8. Buka browser Anda dan kunjungi: `http://localhost:8000`

---

## 👥 Pengguna Demo

Jika Anda telah menjalankan fitur `--seed` di atas, Anda bisa langsung mencoba masuk menggunakan akun demo berikut:

- **Email:** `demo@myduit.test`
- **Password:** `password`

_Dikembangkan dengan ❤️ untuk pencatatan keuangan yang lebih cerdas dan praktis._
