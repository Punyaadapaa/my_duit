<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Kurs awal buat fitur "Cek Kurs Real-time" di landing page.
     * Nanti bisa diganti job/cron yang ambil data asli dari API kurs.
     */
    public function run(): void
    {
        ExchangeRate::create([
            'base_currency' => 'USD',
            'target_currency' => 'IDR',
            'rate' => 15650.00,
            'change_percent' => 0.20,
            'fetched_at' => now(),
        ]);
    }
}