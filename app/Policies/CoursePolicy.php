<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view courses');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Course $course): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('view courses');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('create courses');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Course $course): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('update courses');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Course $course): bool
    {
        return $admin->is_superadmin || $admin->hasPermissionTo('delete courses');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Course $course): bool
    {
        return false;
    }
}
