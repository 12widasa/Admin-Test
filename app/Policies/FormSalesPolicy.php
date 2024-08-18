<?php

namespace App\Policies;

use App\Models\FormSales;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormSalesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     // return $user->role === User::ROLE_SALES;
    //     return true;
    // }

    public function viewAny(User $user): bool
    {
        // Izinkan hanya user dengan peran 'sales' untuk melihat Sales Report
        return $user->role === 'sales';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FormSales $formSales): bool
    {
        return $user->role === 'sales';
        
    }

    /**
     * Determine whether the user can create models.
     */
    // public function create(User $user): bool
    // {
    //     // Izinkan hanya user dengan peran 'superadmin' untuk mengakses form sales
    //     return $user->role === 'sales';
    // }

    /**
     * Determine whether the user can update the model.
    //  */
    // public function update(User $user, FormSales $formSales): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    // public function delete(User $user, FormSales $formSales): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, FormSales $formSales): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, FormSales $formSales): bool
    // {
    //     //
    // }
}
