<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->optional()->paragraph(),
            'price' => fake()->randomFloat(2, 1, 500000),
            'stock_quantity' => fake()->numberBetween(0, 200),
            'photo_path' => null,
        ];
    }
}
