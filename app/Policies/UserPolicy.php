<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function create(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create']);
    }

    public function update(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create']);
    }

    public function delete(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create']);
    }

    public function createProduct(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create', 'admin_view']);
    }

    public function updateProduct(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create', 'admin_view']);
    }

    public function deleteProduct(User $user): bool
    {
        return in_array($user->role, ['superadmin', 'admin_create', 'admin_view']);
    }
}
