<?php

namespace App\Nova;

use App\Enums\Admins\Type;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Expert extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Expert>
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
        'id', 'name', 'email',
    ];

    public static function label()
    {
        return __('Experts');
    }

    public static function singularLabel()
    {
        return __('Expert');
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type', Type::EXPERT)->get();
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
            Text::make(__('Name'), 'name')->sortable()->required(),
            Text::make(__('Email'), 'email')->sortable()
                ->rules('required', 'email', 'max:255', 'unique:experts,email'),

            Image::make(__('Image'), 'image')
                ->disk('public')
                ->path('experts')
                ->prunable()
                ->nullable()
                ->rules('mimes:jpeg,jpg,png,gif,svg'),

            File::make(__('CV'), 'cv_file')
                ->disk('public')
                ->path('assets')
                ->prunable()
                ->required()
                ->rules('mimes:pdf'),

            BelongsTo::make(__('Category'), 'category', Category::class)
                ->sortable()
                ->required(),

            Text::make(__('Bio'), 'bio')
                ->onlyOnDetail()
                ->sortable()
                ->nullable(),

            Number::make(__('Years of Experience'), 'years_of_experience')
                ->sortable()
                ->rules('required', 'integer'),

            Number::make(__('Phone Number'), 'phone_number')
                ->sortable()
                ->rules('required', 'numeric'),

            BelongsToMany::make(__('Courses'), 'courses', Course::class),

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
        return [
        ];
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
        return [
        ];
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
}
