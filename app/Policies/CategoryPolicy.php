<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;
    public function view(Admin $admin, Category $category): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view categories');
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('create categories');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Category $category): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('update categories');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Category $category): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('delete categories');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Category $category): bool
    {
        return false;
    }
}
