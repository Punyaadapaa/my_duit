<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null, // default: kategori global
            'name' => fake()->words(2, true),
            'type' => fake()->randomElement(['income', 'expense']),
            'icon' => 'category',
            'color' => 'primary',
        ];
    }

    public function income(): static
    {
        return $this->state(fn (array $attributes) => ['type' => 'income']);
    }

    public function expense(): static
    {
        return $this->state(fn (array $attributes) => ['type' => 'expense']);
    }
}
