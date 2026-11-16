# Courses

Laravel API for a course platform, with a Nova admin for managing content.

## What it includes

- Phone registration, OTP verification, and password reset
- Public course list and course details
- Authenticated course reviews
- Admin panel with Laravel Nova, Spatie permissions, and translations

## Stack

PHP 8.2, Laravel 11, Laravel Nova 4, Sanctum, Spatie Permission, Spatie Translatable

## Run locally

Nova is a licensed package. Add your Nova credentials before installing dependencies.

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```
