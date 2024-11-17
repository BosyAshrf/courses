<?php

namespace App\Enums\User;

enum OTPEvent : string
{
    case LOGIN              = 'login';
    case REGISTER           = 'register';
    case CHANGE_EMAIL       = 'change_email';
    case CHANGE_PASSWORD    = 'change_password';
    case CHANGE_PHONE_NUMBER= 'change_phone_number';

    public function title(): string
    {
        return match ($this) {
            self::LOGIN => __('Login'),
            self::REGISTER => __('Register'),
            self::CHANGE_EMAIL => __('Change Email'),
            self::CHANGE_PASSWORD => __('Change Password'),
            self::CHANGE_PHONE_NUMBER => __('Change Phone Number'),
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($item) =>[ $item->value => $item->title()])->toArray();
    }
}
