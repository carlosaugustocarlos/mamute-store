<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;

class StorePolicy
{
    public function view(User $user, Store $store): bool
    {
        return $store->user()->is($user);
    }

    public function update(User $user, Store $store): bool
    {
        return $store->user()->is($user);
    }

    public function delete(User $user, Store $store): bool
    {
        return $store->user()->is($user);
    }
}
