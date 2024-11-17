<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Oneduo\NovaFileManager\FileManager;
use Spatie\NovaTranslatable\Translatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\File;
use Mostafaznv\NovaVideo\Video;


class Lesson extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Lesson>
     */
    public static $model = \App\Models\Lesson::class;

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
        'id','name'
    ];

    public static function label()
    {
        return __('Lessons');
    }

    public static function singularLabel()
    {
        return __('Lesson');
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

            BelongsTo::make(__('Section'),'section',Section::class),

            Translatable::make([
                Text::make(__('Name'),'name')->rules('required'),
            ]),

            Translatable::make([
                Text::make(__('Description'),'description')->rules('nullable'),
            ]),

            FileManager::make(__('Video'),'video')
                ->rules('required')
                ->hideFromIndex(),
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
