<?php

namespace App\Providers;

use App\Enums\Admins\Type;
use App\Models\Admin as ModelsAdmin;
use App\Models\Expert as ModelsExpert;
use App\Models\User as ModelsUser;
use App\Nova\Admin;
use App\Nova\Category;
use App\Nova\Course;
use App\Nova\Expert;
use App\Nova\Language;
use App\Nova\User;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Pktharindu\NovaPermissions\Nova\Role;
use Laravel\Nova\NovaApplicationServiceProvider;
use Oneduo\NovaFileManager\NovaFileManager;
use Outl1ne\NovaSettings\NovaSettings;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->NovaSettings();
        Nova::booted(function () {
            app()->setlocale('ar');
        });
        Nova::footer(function ($request) {
            return Blade::render('
                @env(\'prod\')
                    This is production!
                @endenv
            ');
        });

        Gate::define('view roles', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view roles');
        });
        Gate::define('view admins', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view admins');
        });
        Gate::define('view users', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view users');
        });
        Gate::define('view courses', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view courses');
        });
        Gate::define('view categories', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view categories');
        });
        Gate::define('view experts', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view experts');
        });
        Gate::define('view_general_settings', function ($admin) {
            return $admin->is_superadmin || $admin->hasPermission('view_general_settings');
        });


        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::make(__('Main'))->path('dashboards/main')
                ->canSee(fn($request) => Gate::allows('view main', $request->user()))
                ->icon('chart-bar'),

                  MenuSection::make(__('Admin Management'), [
                    MenuItem::resource(Admin::class)
                        ->withBadge(fn() => ModelsAdmin::where('type',Type::ADMIN)->count(), 'danger')
                        ->canSee(fn($request) => Gate::allows('view admins', $request->user())),

                        MenuItem::resource(Expert::class)
                        ->withBadge(fn() => ModelsAdmin::where('type',Type::EXPERT)->count(), 'warning')
                         ->canSee(fn($request) => Gate::allows('view experts', $request->user())),

                    MenuItem::resource(Role::class)
                        ->canSee(function ($request) {return Gate::allows('view roles', $request->user());}),

                ])->icon('users')->collapsable(),

                MenuSection::make(__('Students Management'), [
                    MenuItem::resource(User::class)
                        ->withBadge(fn() => ModelsUser::count(), 'danger')
                         ->canSee(fn($request) => Gate::allows('view users', $request->user())),
                ])->icon('identification')->collapsable(),


                MenuSection::make(__('Course Management'), [
                    MenuItem::resource(Course::class)
                         ->canSee(fn($request) => Gate::allows('view courses', $request->user())),
                    MenuItem::resource(Category::class)
                         ->canSee(fn($request) => Gate::allows('view categories', $request->user())),

                ])->icon('book-open')->collapsable(),

                MenuSection::make(__('Settings'), [
                    MenuSection::make(__('General'))
                        ->icon('globe')
                        ->path('nova-settings/general')
                        ->canSee(fn($request) => Gate::allows('view_general_settings', $request->user())),
                ])->icon('cog')->collapsable(),

            ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new \Badinansoft\LanguageSwitch\LanguageSwitch(),
            new \Outl1ne\NovaSettings\NovaSettings,
            new \Pktharindu\NovaPermissions\NovaPermissions(),
            NovaFileManager::make(),


        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function NovaSettings(): void
    {
        Nova::serving(function () {

            NovaSettings::addSettingsFields(
                [
                    Tabs::make(__('General'),
                        [
                            Tabs::make(__('Site'), [
                                Image::make(__('Logo'), 'site_logo')->disk('public'),
                            ]),

                        ]
                    )->withToolbar(),
                ]
            );
        });
    }

}
