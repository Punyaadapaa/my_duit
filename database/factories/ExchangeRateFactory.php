<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExchangeRate>
 */
class ExchangeRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'base_currency' => 'USD',
            'target_currency' => 'IDR',
            'rate' => fake()->randomFloat(4, 15000, 16000),
            'change_percent' => fake()->randomFloat(4, -1, 1),
            'fetched_at' => now(),
        ];
    }
}