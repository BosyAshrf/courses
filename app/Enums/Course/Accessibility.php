<?php

namespace App\Enums\Course;

enum Accessibility : string
{
    case Public     = 'public';
    case Private    = 'private';

    public function title(): string
    {
        return match ($this) {
            self::Public    => __('Public'),
            self::Private   => __('Private'),
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($item) =>[ $item->value => $item->title()])->toArray();
    }
}
