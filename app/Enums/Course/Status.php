<?php

namespace App\Enums\Course;

enum Status : string
{
    case DRAFT      = 'draft';
    case PUBLISHED  = 'published';

    public function title(): string
    {
        return match ($this) {
            self::DRAFT     => __('draft'),
            self::PUBLISHED => __('published'),
        };
    }

    public function badge()
    {
        return match ($this) {
            self::DRAFT     => 'warning',
            self::PUBLISHED => 'success',
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($item) =>[ $item->value => $item->title()])->toArray();
    }

    public static function badges()
    {
        return collect(self::cases())->mapWithKeys(fn($item) => [$item->value => self::from($item->value)->badge()])->toArray();
    }
}
