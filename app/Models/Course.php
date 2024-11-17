<?php

namespace App\Models;

use App\Enums\Course\Status;
use App\Enums\Course\Type;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Oneduo\NovaFileManager\Casts\Asset;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'subtitle',
        'description',
    ];

    protected function casts()
    {
        return [
            'type' => Type::class,
            'status' => Status::class,
            'video_preview' => Asset::class,
        ];
    }

    /*--------------------------------------------------- Scopes ---------------------------------------------------*/

    public function scopePublished($query)
    {
        return $query->where('status', Status::PUBLISHED);
    }

    public function scopeSearch($query)
    {
        return $query->where('title', 'like', "%" . request('search') . "%")
            ->orWhere('subtitle', 'like', "%" . request('search') . "%")
            ->orWhere('description', 'like', "%" . request('search') . "%");
    }

    public function scopeFilters($query)
    {
        return $query
            ->when(request()->has('category'), function ($q) {
                $categories = request('category');
                if (is_array($categories)) {
                    $q->whereIn('category_id', $categories);
                } else {
                    $q->where('category_id', $categories);
                }
            })

            ->when(request()->has('type'), function ($q) {
                $types = request('type');
                if (is_array($types)) {
                    $q->whereIn('type', $types);
                } else {
                    $q->where('type', $types);
                }
            });
    }

    /*--------------------------------------------------- Attributes ---------------------------------------------------*/

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset("storage/{$this->image}"),
        );
    }

    public function videoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->video_preview ? asset("storage/{$this->video_preview->path}") : null,
        );
    }

    /*--------------------------------------------------- Relationships ---------------------------------------------------*/

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }
    
    public function experts()
    {
        return $this->belongsToMany(Admin::class, 'course_experts', 'course_id', 'expert_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id');
    }
    
    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')->withPivot('group_id');
    }

    /*--------------------------------------------------- Helpers ---------------------------------------------------*/

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getStatusTranslatedAttribute() {
        return __($this->attributes['status']);
    }

}
