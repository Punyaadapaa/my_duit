<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['income', 'expense']);

        return [
            'user_id' => User::factory(),
            'wallet_id' => Wallet::factory(),
            // Pakai kategori yang SUDAH ADA di tabel (hasil CategorySeeder),
            // bukan bikin kategori baru tiap kali ada transaksi.
            'category_id' => fn (array $attributes) => Category::where('type', $attributes['type'] ?? $type)
                ->inRandomOrder()
                ->value('id'),
            'type' => $type,
            'amount' => $type === 'income'
                ? fake()->randomFloat(2, 50000, 5000000)
                : fake()->randomFloat(2, 5000, 500000),
            'note' => fake()->sentence(3),
            'transaction_date' => fake()->dateTimeBetween('-30 days', 'now'),
        ];
    }

    public function income(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'income',
            'amount' => fake()->randomFloat(2, 50000, 5000000),
            'category_id' => Category::where('type', 'income')->inRandomOrder()->value('id'),
        ]);
    }

    public function expense(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'expense',
            'amount' => fake()->randomFloat(2, 5000, 500000),
            'category_id' => Category::where('type', 'expense')->inRandomOrder()->value('id'),
        ]);
    }
}