<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()
            ->count(5)
            ->create()
            ->each(function (User $user): void {
                Store::factory()
                    ->count(fake()->numberBetween(3, 4))
                    ->for($user)
                    ->create()
                    ->each(function (Store $store): void {
                        Product::factory()
                            ->count(fake()->numberBetween(10, 15))
                            ->for($store)
                            ->create();
                    });
            });
    }
}
