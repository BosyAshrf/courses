<?php

namespace App\Models;

use Oneduo\NovaFileManager\Casts\Asset;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'name','description'
    ];

    protected function casts(): array
    {
        return [
            'video' => Asset::class,
        ];
    }

    public function videoUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->video ? asset("storage/{$this->video->path}") : null,
        );
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

}
