<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_product_with_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $store = Store::factory()->for($user)->create();

        $response = $this->actingAs($user)->post(route('products.store'), [
            'store_id' => $store->id,
            'name' => 'Monitor LED',
            'description' => 'Monitor para escritório',
            'price' => 125000,
            'stock_quantity' => 8,
            'photo' => $this->validPngUpload(),
        ]);

        $product = Product::first();

        $response->assertRedirect(route('products.show', $product));

        $this->assertDatabaseHas('products', [
            'store_id' => $store->id,
            'name' => 'Monitor LED',
            'stock_quantity' => 8,
        ]);

        Storage::disk('public')->assertExists($product->photo_path);
    }

    public function test_user_cannot_create_product_for_another_users_store(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $store = Store::factory()->for($otherUser)->create();

        $this->actingAs($user)
            ->post(route('products.store'), [
                'store_id' => $store->id,
                'name' => 'Produto inválido',
                'price' => 1000,
                'stock_quantity' => 1,
            ])
            ->assertSessionHasErrors('store_id');
    }

    public function test_user_only_sees_products_from_their_stores(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $store = Store::factory()->for($user)->create();
        $otherStore = Store::factory()->for($otherUser)->create();

        $ownProduct = Product::factory()->for($store)->create(['name' => 'Produto Próprio']);
        $otherProduct = Product::factory()->for($otherStore)->create(['name' => 'Produto Externo']);

        $this->actingAs($user)
            ->get(route('products.index'))
            ->assertOk()
            ->assertSee($ownProduct->name)
            ->assertDontSee($otherProduct->name);
    }

    public function test_product_filters_can_be_combined(): void
    {
        $user = User::factory()->create();
        $store = Store::factory()->for($user)->create();
        $otherStore = Store::factory()->for($user)->create();

        $matchingProduct = Product::factory()->for($store)->create([
            'name' => 'Teclado Mecânico',
            'price' => 30000,
            'stock_quantity' => 5,
        ]);

        Product::factory()->for($store)->create([
            'name' => 'Teclado Simples',
            'price' => 5000,
            'stock_quantity' => 10,
        ]);

        Product::factory()->for($otherStore)->create([
            'name' => 'Teclado Premium',
            'price' => 35000,
            'stock_quantity' => 0,
        ]);

        $this->actingAs($user)
            ->get(route('products.index', [
                'search' => 'Teclado',
                'store_id' => $store->id,
                'min_price' => 10000,
                'max_price' => 40000,
                'in_stock' => 1,
            ]))
            ->assertOk()
            ->assertSee($matchingProduct->name)
            ->assertDontSee('Teclado Simples')
            ->assertDontSee('Teclado Premium');
    }

    public function test_user_cannot_update_another_users_product(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $store = Store::factory()->for($otherUser)->create();
        $product = Product::factory()->for($store)->create();

        $this->actingAs($user)
            ->put(route('products.update', $product), [
                'store_id' => $store->id,
                'name' => 'Tentativa',
                'price' => 1000,
                'stock_quantity' => 1,
            ])
            ->assertSessionHasErrors('store_id');
    }

    private function validPngUpload(): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'product-photo');

        file_put_contents($path, base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII='
        ));

        return new UploadedFile($path, 'monitor.png', 'image/png', null, true);
    }
}
