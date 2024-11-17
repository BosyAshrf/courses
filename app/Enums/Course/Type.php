<?php

namespace App\Enums\Course;

enum Type: string
{
    case RECORDED   = 'recorded'; // contians video
    case ONLINE     = 'online'; // contains live session [Zoom, Google Meet]
    case OFFLINE    = 'offline'; // contains physical class

    public function title(): string
    {
        return match ($this) {
            self::RECORDED  => __('Recorded'),
            self::ONLINE    => __('Online'),
            self::OFFLINE   => __('Offline'),
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($item) =>[ $item->value => $item->title()])->toArray();
    }

    public static function all()
    {
        return collect(self::cases())->map(fn ($item) =>[
            'id' => $item->value,
            'title' => $item->title(),
        ])->toArray();
    }
}
