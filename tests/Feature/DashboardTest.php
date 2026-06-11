<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_user_indicators(): void
    {
        $user = User::factory()->create();
        $store = Store::factory()->for($user)->create();

        Product::factory()->for($store)->create([
            'price' => 1000,
            'stock_quantity' => 3,
        ]);

        Product::factory()->for($store)->create([
            'price' => 2500,
            'stock_quantity' => 2,
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Total de lojas')
            ->assertSee('1')
            ->assertSee('Total de produtos')
            ->assertSee('2')
            ->assertSee('8.000,00');
    }
}
