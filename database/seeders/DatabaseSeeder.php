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
        $admin = User::factory()->create([
            'name' => 'Mamute Admin',
            'email' => 'test@example.com',
        ]);

        $users = collect([$admin])->merge(User::factory()->count(2)->create());

        collect(range(1, 10))
            ->map(fn (int $position) => Store::factory()
                ->for($users[($position - 1) % $users->count()])
                ->create())
            ->each(fn (Store $store) => Product::factory()
                ->count(10)
                ->for($store)
                ->create());
    }
}
