<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use App\Enums\User\Type;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;

class User extends Resource
{
    use HasTabs;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

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
        return __('Students');
    }

    public static function singularLabel()
    {
        return __('Student');
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
            // Gravatar::make()->maxWidth(50),

            Image::make(__('Avatar'),'image')
                ->disk('public')
                ->path('images/users')
                ->maxWidth(50),

            Text::make(__('Name'),'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Email'),'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make(__('Phone'),'phone_number')
                ->sortable()
                ->rules('required', 'max:255'),


            Password::make(__('Password'),'password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),

            Tabs::make('Relations',[
                BelongsToMany::make(__('Enrollments'),'enrollments',Course::class)
                    ->fields(function ($request, $relatedModel) {
                        return [
                            // Create Group
                            Select::make(__('Group'),'group_id')
                                ->hide()
                                ->hideFromIndex()
                                ->dependsOn('enrollments',function (Select $field,NovaRequest $request,FormData $fromData){
                                    if($fromData['enrollments'] && \App\Models\Course::find($fromData['enrollments'])->type != \App\Enums\Course\Type::RECORDED){
                                        $field->show()->options(\App\Models\Group::where('course_id',$fromData['enrollments'])->get()->pluck('name','id'));
                                    }
                                }),

                            // Update Group
                            Select::make(__('Group'),'group_id')
                                ->hideWhenCreating()
                                ->hideFromIndex()
                                ->options(fn () => $this->enrollments->first()?->groups?->pluck('name','id')),
                        ];
                    }),

                HasMany::make(__('Reviews'),'reviews',Review::class),
            ]),
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
