<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Language extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'name'
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
