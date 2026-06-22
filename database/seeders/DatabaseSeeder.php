<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ExchangeRateSeeder::class,
        ]);

        // User demo buat dicoba-coba di local/development.
        // Login: demo@myduit.test / password
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@myduit.test',
        ]);

        $wallet = Wallet::create([
            'user_id' => $user->id,
            'balance' => 0, // nanti keisi otomatis dari transaksi di bawah
            'currency' => 'IDR',
        ]);

        $makan = Category::where('name', 'Makan')->where('type', 'expense')->first();
        $tagihan = Category::where('name', 'Tagihan')->where('type', 'expense')->first();
        $gaji = Category::where('name', 'Gaji')->where('type', 'income')->first();

        // Disusun supaya saldo akhir mendekati contoh di mockup hero (≈ Rp9.465.000)
        Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'category_id' => $gaji->id,
            'type' => 'income',
            'amount' => 15000000,
            'note' => 'Gaji bulanan',
            'transaction_date' => now()->subDays(5),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'category_id' => $makan->id,
            'type' => 'expense',
            'amount' => 45000,
            'note' => 'makan malam',
            'transaction_date' => now()->subDays(1),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'category_id' => $tagihan->id,
            'type' => 'expense',
            'amount' => 100000,
            'note' => 'top up e-wallet',
            'transaction_date' => now()->subDays(1),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'category_id' => $makan->id,
            'type' => 'expense',
            'amount' => 5390000,
            'note' => 'Pengeluaran bulan ini (sisanya, biar mirip contoh mockup)',
            'transaction_date' => now()->subDays(2),
        ]);

        // Beberapa user + transaksi acak tambahan, kalau mau lihat data lebih ramai
        User::factory(5)
            ->has(Wallet::factory())
            ->create()
            ->each(function (User $u) {
                Transaction::factory(10)->create([
                    'user_id' => $u->id,
                    'wallet_id' => $u->wallet->id,
                ]);
            });
    }
}