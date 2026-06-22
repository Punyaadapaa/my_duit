# 💰 MyDuit - Personal Finance Tracker

**MyDuit** adalah aplikasi berbasis web pintar yang dirancang untuk membantu Anda memantau, mencatat, dan mengelola arus kas pribadi (pemasukan dan pengeluaran) secara mudah, efisien, dan modern.

Dibangun dengan antarmuka yang sangat responsif, _clean_, dan mendukung penuh peralihan tema Terang/Gelap (_Light/Dark Mode_), MyDuit menghadirkan pengalaman pencatatan keuangan premium langsung di ujung jari Anda. Desain MyDuit telah dioptimalkan untuk tampil sempurna di semua perangkat, mulai dari _smartphone_, tablet, hingga layar desktop.

---

## 🌟 Fitur Unggulan

### 1. 🚀 Landing Page Interaktif & Modern

- **Desain Premium:** Menggunakan kombinasi _glassmorphism_, animasi _micro-interactions_ (_pulse_, _bounce_), dan palet warna modern yang dirancang khusus.
- **Responsif di Segala Perangkat:** Layout secara otomatis menyesuaikan diri. Di _mobile_ menggunakan tampilan satu kolom yang ringkas, sedangkan di tablet/desktop mengoptimalkan ruang layar yang lebih luas.
- **Robust Styling:** Komponen kritis pada UI menggunakan pendekatan _inline-styles_ yang dikalkulasi secara presisi, sehingga terhindar dari isu kompilasi _utility classes_ dan menjamin konsistensi tampilan.

### 2. 🔐 Autentikasi Mandiri & Cepat

- **Custom Auth System:** Menggunakan sistem login dan registrasi buatan khusus (tanpa _boilerplate_ berat), memastikan aplikasi berjalan sangat ringan.
- **Auto-Wallet Generation:** Ketika pengguna baru mendaftar, sistem di latar belakang otomatis membuatkan entitas "Dompet Utama" (_Wallet_) dengan saldo awal Rp 0.

### 3. 📊 Dashboard Pintar

- **Ringkasan Real-Time:** Dashboard otomatis menghitung dan menampilkan "Total Pemasukan Bulan Ini" serta "Total Pengeluaran Bulan Ini" secara akurat.
- **Daftar Transaksi Rapi:** Menampilkan transaksi dengan standar UI aplikasi _finance_ terkini (Nama Kategori tebal di atas, tanggal & catatan ringkas di bawah), lengkap dengan _color-coding_.

### 4. 💸 Transaksi Anti-Repot (Modal Interaktif)

- **Unified Form:** Menambah atau mengedit transaksi (Pemasukan/Pengeluaran) dilakukan melalui sebuah jendela _pop-up_ (Modal) yang modern dan mulus tanpa perlu pindah halaman.
- **Kategori Cerdas:** Pilihan kategori beradaptasi otomatis sesuai dengan tipe transaksi yang dipilih.
- **Pengingat Data Presisi:** Jika terdapat _error_ validasi, Modal akan terbuka kembali secara otomatis tanpa menghilangkan data yang sudah diketik.

### 5. 🧠 Logika Saldo "Anti-Lag" (Smart Model Observers)

Aplikasi ini memiliki "otak pintar" di tingkat Model Database (`Transaction.php`). Setiap kali Anda melakukan perubahan transaksi, Saldo Utama akan sinkron secara otomatis:

- **Tambah Transaksi:** Saldo otomatis bertambah/berkurang.
- **Hapus Transaksi:** Efek dari transaksi tersebut akan di-_rollback_ ke saldo seolah tidak pernah terjadi.
- **Edit Nominal:** Sistem akan mengkalkulasi selisih nominal lama dan baru secara otomatis tanpa merusak keseimbangan saldo.

---

## 💻 Teknologi yang Digunakan

Aplikasi MyDuit mengombinasikan ketangguhan _backend_ dan keindahan _frontend_ terkini:

- **Framework Backend:** Laravel (PHP)
- **Framework Frontend:** HTML5 & Blade Templating Engine
- **Styling Utama:** Tailwind CSS
- **Styling Kritis:** Kombinasi _Vanilla CSS_ (`app.css` dengan CSS Variables) dan _Inline Styles_ terstruktur untuk memastikan _rendering_ UI tidak pernah rusak.
- **Database:** MySQL / SQLite
- **Interaktivitas:** Vanilla JavaScript murni (Cepat, aman, tanpa dependensi _library_ eksternal yang berat)

---

## 🚀 Cara Menjalankan Project (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan MyDuit di komputer Anda:

1. **Persiapan:** Pastikan Anda telah menginstal PHP, Composer, Node.js, dan MySQL (Bisa menggunakan Laragon/XAMPP).
2. **Kloning Repositori & Install Dependencies:**
    ```bash
    composer install
    npm install
    ```
3. **Konfigurasi Environment:**
   Buka file `.env` dan sesuaikan pengaturan database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_MyDuit
    DB_USERNAME=root
    DB_PASSWORD=
    ```
4. **Jalankan Migrasi & Seeder Database:**
   Perintah ini akan membuat semua struktur tabel dan mengisi data kategori bawaan (_Makan, Tagihan, Gaji_, dll).
    ```bash
    php artisan migrate:fresh --seed
    ```
5. **Kompilasi Aset CSS & JS:**
    ```bash
    npm run build
    # Gunakan `npm run dev` jika Anda berencana memodifikasi CSS/JS secara live.
    ```
6. **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```
7. **Selesai!** Buka browser Anda dan kunjungi: `http://localhost:8000`

---

## 👥 Pengguna Demo

Jika Anda telah menjalankan fitur `--seed` di atas, Anda bisa langsung mencoba masuk menggunakan akun demo berikut:

- **Email:** `demo@myduit.test`
- **Password:** `password`

Anda juga bebas membuat akun baru melalui tombol **Daftar** di halaman awal.

---

_Dikembangkan dengan ❤️ untuk pencatatan keuangan yang lebih baik._
