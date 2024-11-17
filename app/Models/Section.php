<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'title',
        'description'
    ];

    public function lessons() : HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function course() : BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
