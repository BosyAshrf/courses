<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Enums\Course\Type;
use Oneduo\NovaFileManager\FileManager;
use Spatie\NovaTranslatable\Translatable;
use Laravel\Nova\Fields\Image;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Traits\HasTabs;
use App\Enums\Course\Status;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Mostafaznv\NovaVideo\Video;

class Course extends Resource
{
    use HasTabs;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Course>
     */
    public static $model = \App\Models\Course::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','title','subtitle','description'
    ];

    public static function label()
    {
        return __('Courses');
    }

    public static function singularLabel()
    {
        return __('Course');
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
            Image::make(__('Image'),'image')
                ->rules('mimetypes:image/jpeg,image/png,image/jpg,image/svg')
                ->creationRules('required')
                ->disk('public')
                ->path('courses')
                ->sortable(),

            Translatable::make([
                Text::make(__('Title'),'title')
                    ->rules('required')
                    ->sortable(),
                Text::make(__('Subtitle'),'subtitle')
                    ->rules('required')
                    ->hideFromIndex()
                    ->sortable(),
                Textarea::make(__('Description'),'description')
                    ->rules('required')
                    ->sortable(),
            ]),


            FileManager::make(__('Video Preview'),'video_preview')
                ->rules('required')
                ->hideFromIndex(),

            Image::make(__('Preview Cover'),'preview_cover')
                ->rules('mimetypes:image/jpeg,image/png,image/jpg,image/svg')
                ->disk('public')
                ->path('courses')
                ->hideFromIndex(),

            Number::make(__('Price'),'price')->default(0)->rules('required')->sortable(),
            Number::make(__('Offer Price'),'offer_price')->default(0)->sortable(),

            Select::make(__('Type'),'type')
                ->rules('required')
                ->default(Type::RECORDED->value)
                ->options(Type::options())
                ->displayUsingLabels(),

            Select::make(__('Status'),'status')
                ->rules('required')
                ->default(Status::DRAFT->value)
                ->options(Status::options())
                ->onlyOnForms(),

            Badge::make(__('Status'), 'status')
                ->map(Status::badges())
                ->hideWhenUpdating()
                ->labels(Status::options()),

            BelongsTo::make(__('Category'),'category',Category::class),

            Tabs::make('Relations',[
                 HasMany::make(__('Sections'),'sections',Section::class)->hideFromDetail(fn() => $this->type != Type::RECORDED),
                 HasMany::make(__('Groups'),'groups',Group::class)->hideFromDetail(fn() => $this->type == Type::RECORDED),
                HasMany::make(__('Reviews'),'reviews',Review::class),
                BelongsToMany::make(__('Enrollments'),'enrollments',User::class)
                    ->fields(function ($request, $relatedModel) {
                        return [
                            Select::make(__('Group'),'group_id')
                                ->hideWhenCreating(fn() => $this->type == Type::RECORDED)
                                ->hideWhenUpdating(fn() => $this->type == Type::RECORDED)
                                ->searchable()
                                ->options(\App\Models\Group::where('course_id',$this->id)->get()->pluck('name','id'))
                                ->displayUsingLabels(),
                        ];
                    }),

                    BelongsToMany::make(__('Experts'),'experts',Expert::class)
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

    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     if($request->user()->is_superadmin){
    //         return $query;
    //     }
    //     return $query->where('expert_id', $request->user()->expert->id);
    // }
}
