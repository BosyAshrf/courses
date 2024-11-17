<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;

class Review extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Review>
     */
    public static $model = \App\Models\Review::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'review';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','comment'
    ];

    public static function label()
    {
        return __('Reviews');
    }

    public static function singularLabel()
    {
        return __('Review');
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
            BelongsTo::make(__('Course'),'course',Course::class),
            BelongsTo::make(__('User'),'user',User::class),
            Number::make(__('Rating'),'rating')
                ->min(1)
                ->max(5)
                ->rules('required'),
            Textarea::make(__('Comment'),'comment')
                ->rules('nullable'),
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

    public static function authorizedToCreate(Request $request): bool
    {
        return false;
    }

    public function authorizedToDelete(Request $request): bool
    {
        return false;
    }

    public function authorizedToUpdate(Request $request): bool
    {
        return true;
    }

    public function authorizedToReplicate(Request $request): bool
    {
        return false;
    }
}
