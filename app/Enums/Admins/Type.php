<?php

namespace App\Enums\Admins;

enum Type: string {
    case ADMIN      = 'admin';
    case EXPERT     = 'expert';

    public function title()
    {
        return match ($this) {
            self::ADMIN       => __('Admin'),
            self::EXPERT    => __('Expert'),
        };
    }

    public static function options()
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn($item) => [$item->value => self::from($item->value)->title()]
            )->toArray();
    }

    public function badge()
    {
        return match ($this) {
            self::ADMIN      => 'success',
            self::EXPERT   => 'danger',
        };
    }

    public static function badges()
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn($item) => [$item->value => self::from($item->value)->badge()]
            )->toArray();
    }
}
