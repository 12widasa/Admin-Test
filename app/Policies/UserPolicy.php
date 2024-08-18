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

    // public function update(User $user): bool
    // {
    //     return in_array($user->role, ['superadmin', 'admin_create']);
    // }

    public function update(User $user, User $targetUser): bool
    {
        // Superadmin hanya bisa mengedit dirinya sendiri
        if ($user->role === User::ROLE_SUPERADMIN) {
            return true;
        }

        // Admin_create bisa mengedit semua user kecuali superadmin
        if ($user->role === User::ROLE_ADMIN_CREATE) {
            return $targetUser->role !== User::ROLE_SUPERADMIN;
        }

        return false;
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
    public function viewAny(User $user): bool
{
    // Misalnya, hanya user dengan role tertentu yang bisa melihat produk
    return in_array($user->role, [
        User::ROLE_SUPERADMIN,
        User::ROLE_ADMIN_CREATE,
        User::ROLE_ADMIN_VIEW,
    ]);
}
}
