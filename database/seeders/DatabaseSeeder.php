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
        $demoUser = User::factory()->create([
            'name' => 'Utilizador Demo',
            'email' => 'test@example.com',
        ]);

        $users = User::factory()
            ->count(2)
            ->create()
            ->prepend($demoUser);

        $users->each(function (User $user, int $index): void {
            Store::factory()
                ->count($index === 0 ? 4 : 3)
                ->for($user)
                ->create()
                ->each(function (Store $store): void {
                    Product::factory()
                        ->count(10)
                        ->for($store)
                        ->create();
                });
        });
    }
}
