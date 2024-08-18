<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Filament\Resources\UserResource;



class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // atau sesuaikan dengan logika Anda
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true; // atau sesuaikan dengan logika Anda
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya user dengan role tertentu yang dapat membuat product
        return in_array($user->role, [User::ROLE_SUPERADMIN, User::ROLE_ADMIN_CREATE]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        // Hanya superadmin dan admin_create yang bisa update
        return in_array($user->role, [User::ROLE_SUPERADMIN, User::ROLE_ADMIN_CREATE]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        // Hanya superadmin dan admin_create yang bisa delete
        return in_array($user->role, [User::ROLE_SUPERADMIN, User::ROLE_ADMIN_CREATE]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->role === User::ROLE_SUPERADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->role === User::ROLE_SUPERADMIN;
    }
}