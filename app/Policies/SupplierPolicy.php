<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Supplier;

class SupplierPolicy
{
    public function view(User $user, Supplier $supplier): bool
    {
        return $user->id === $supplier->user_id;
    }

    public function update(User $user, Supplier $supplier): bool
    {
        return $user->id === $supplier->user_id;
    }

    public function delete(User $user, Supplier $supplier): bool
    {
        return $user->id === $supplier->user_id;
    }
}
