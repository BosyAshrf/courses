<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Telegraph;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\AdminPolicy;
use App\Policies\BrandPolicy;
use App\Models\CommonQuestion;
use App\Policies\CouponPolicy;
use App\Policies\ContactPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\TelegraphPolicy;
use Illuminate\Support\Facades\Gate;
use Pktharindu\NovaPermissions\Role;
use App\Models\CommonQuestionCategory;
use App\Policies\CommonQuestionPolicy;
use App\Policies\CommonQuestionCategoryPolicy;
use Pktharindu\NovaPermissions\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Role::class             => RolePolicy::class,

    ];  

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach (config('nova-permissions.permissions') as $key => $permissions) {
            Gate::define($key, function (Admin $admin) use ($key) {
                if ($this->nobodyHasAccess($key)) {
                    return true;
                }

                return $admin->hasPermissionTo($key);
            });
        }
    }
}
