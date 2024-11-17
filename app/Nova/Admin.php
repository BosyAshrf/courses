<?php

namespace App\Nova;

use App\Enums\Admins\Type;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasMany;
use Pktharindu\NovaPermissions\Nova\Role;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Line;

class Admin extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Admin>
     */
    public static $model = \App\Models\Admin::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email'
    ];

    public static function label()
    {
        return __('Admins');
    }

    public static function singularLabel()
    {
        return __('Admin');
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type',  Type::ADMIN)->get();
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Stack::make(__('Name'), [
                Line::make(__('Name'), 'name')->asHeading(),
                // Line::make(__('Role'),function () {
                //     return $this->is_superadmin ? __('Super Admin'): $this->roles->implode('name', ', ');
                // })->asSmall(),
            ]),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255')
                ->onlyOnForms(),

            Text::make(__('Email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:255', 'unique:admins,email'),

            Password::make(__('Password'), 'password')
                ->rules('required', 'min:8'),

            Image::make(__('Avatar'), 'avatar')
                ->nullable(),

            // HasOne::make(__('Expert'), 'expert', Expert::class),
            BelongsToMany::make(__('Roles'), 'roles', Role::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
