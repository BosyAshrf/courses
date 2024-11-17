<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'name',
    ];

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset("storage/{$this->image}"),
        );
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function scopeSearch($query)
    {
        return $query->where('name', 'like', "%" . request('search') . "%");
    }

}
