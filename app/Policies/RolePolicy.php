<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Pktharindu\NovaPermissions\Role;

class RolePolicy
{
    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view roles');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Role $role): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view roles');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('create roles');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Role $role): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('update roles');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Role $role): bool
    {
        return $role->slug == 'instructor' ? false : $admin->is_superadmin || $admin->hasPermissionTo('delete roles');
    }

}