<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Kategori bawaan MyDuit. user_id null = kategori global,
     * jadi bisa dipakai semua user tanpa perlu bikin ulang.
     */
    public function run(): void
    {
        $categories = [
            // Expense
            ['name' => 'Makan', 'type' => 'expense', 'icon' => 'restaurant', 'color' => 'primary'],
            ['name' => 'Transport', 'type' => 'expense', 'icon' => 'directions_car', 'color' => 'tertiary'],
            ['name' => 'Belanja', 'type' => 'expense', 'icon' => 'shopping_bag', 'color' => 'secondary'],
            ['name' => 'Hiburan', 'type' => 'expense', 'icon' => 'movie', 'color' => 'tertiary'],
            ['name' => 'Tagihan', 'type' => 'expense', 'icon' => 'receipt_long', 'color' => 'expense-red'],
            ['name' => 'Kesehatan', 'type' => 'expense', 'icon' => 'medication', 'color' => 'expense-red'],
            ['name' => 'Pendidikan', 'type' => 'expense', 'icon' => 'school', 'color' => 'primary'],
            ['name' => 'Lainnya', 'type' => 'expense', 'icon' => 'category', 'color' => 'secondary'],

            // Income
            ['name' => 'Gaji', 'type' => 'income', 'icon' => 'payments', 'color' => 'income-green'],
            ['name' => 'Usaha', 'type' => 'income', 'icon' => 'storefront', 'color' => 'income-green'],
            ['name' => 'Hadiah', 'type' => 'income', 'icon' => 'redeem', 'color' => 'tertiary'],
            ['name' => 'Lainnya', 'type' => 'income', 'icon' => 'attach_money', 'color' => 'income-green'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name'], 'type' => $category['type'], 'user_id' => null],
                $category
            );
        }
    }
}