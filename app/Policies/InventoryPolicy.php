<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inventory;

class InventoryPolicy
{
    public function view(User $user, Inventory $inventory): bool
    {
        return $user->id === $inventory->user_id;
    }

    public function update(User $user, Inventory $inventory): bool
    {
        return $user->id === $inventory->user_id;
    }

    public function delete(User $user, Inventory $inventory): bool
    {
        return $user->id === $inventory->user_id;
    }
}
