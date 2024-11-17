<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Admin $admins): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view admins');
    }

    /**
     * Determine whether the user can create models.
     */

    public function create(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('create admins');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Admin $admins): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('update admins');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Admin $admins): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('delete admins');
    }
}
