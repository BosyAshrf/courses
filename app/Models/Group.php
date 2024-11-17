<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $translatable = [
        'name'
    ];

    protected function casts(): array
    {
        return [
            'start_at'  => 'datetime',
            'end_at'    => 'datetime',
        ];
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->start_at->translatedFormat('M d'). ' - ' . $this->end_at->translatedFormat('M d'),
        );
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


}
