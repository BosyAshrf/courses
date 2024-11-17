<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view users');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, User $model): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view users');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('create users');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, User $model): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('edit users');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, User $model): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('delete users');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $admin, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $admin, User $model): bool
    {
        return false;
    }
}
