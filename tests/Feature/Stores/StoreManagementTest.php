<?php

namespace Tests\Feature\Stores;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get(route('stores.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_create_store(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('stores.store'), [
            'name' => 'Loja Central',
            'address' => 'Rua Principal, Luanda',
            'phone' => '+244 923 000 000',
            'email' => 'central@example.com',
        ]);

        $store = Store::first();

        $response->assertRedirect(route('stores.show', $store));

        $this->assertDatabaseHas('stores', [
            'user_id' => $user->id,
            'name' => 'Loja Central',
            'email' => 'central@example.com',
        ]);
    }

    public function test_user_only_sees_their_stores(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $ownStore = Store::factory()->for($user)->create(['name' => 'Loja Própria']);
        $otherStore = Store::factory()->for($otherUser)->create(['name' => 'Loja Externa']);

        $response = $this->actingAs($user)->get(route('stores.index'));

        $response
            ->assertOk()
            ->assertSee($ownStore->name)
            ->assertDontSee($otherStore->name);
    }

    public function test_user_can_update_their_store(): void
    {
        $user = User::factory()->create();
        $store = Store::factory()->for($user)->create();

        $response = $this->actingAs($user)->put(route('stores.update', $store), [
            'name' => 'Loja Actualizada',
            'address' => 'Rua Nova, Luanda',
            'phone' => '+244 924 000 000',
            'email' => 'actualizada@example.com',
        ]);

        $response->assertRedirect(route('stores.show', $store));

        $this->assertDatabaseHas('stores', [
            'id' => $store->id,
            'name' => 'Loja Actualizada',
            'email' => 'actualizada@example.com',
        ]);
    }

    public function test_user_cannot_update_another_users_store(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $store = Store::factory()->for($otherUser)->create();

        $this->actingAs($user)
            ->put(route('stores.update', $store), [
                'name' => 'Tentativa',
                'address' => 'Rua Bloqueada',
                'phone' => '+244 925 000 000',
                'email' => 'tentativa@example.com',
            ])
            ->assertForbidden();
    }

    public function test_user_can_delete_their_store(): void
    {
        $user = User::factory()->create();
        $store = Store::factory()->for($user)->create();

        $this->actingAs($user)
            ->delete(route('stores.destroy', $store))
            ->assertRedirect(route('stores.index'));

        $this->assertDatabaseMissing('stores', [
            'id' => $store->id,
        ]);
    }

    public function test_store_validation_requires_mandatory_fields(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('stores.store'), [])
            ->assertSessionHasErrors(['name', 'address', 'phone', 'email']);
    }
}
