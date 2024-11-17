<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\Course\Type;
use App\Models\Course;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::whereIn('type',[Type::ONLINE,Type::OFFLINE])->get()->each(function ($course) {
            $course->groups()->createMany([
                [
                    'name'          => [
                        'en' => 'First Group',
                        'ar' => 'المجموعة الأولى',
                    ],
                    'start_at'    => now()->startOfMonth()->addMonth(),
                    'end_at'      => now()->startOfMonth()->addMonth()->addDays(9),
                ],
                [
                    'name'          => [
                        'en' => 'Second Group',
                        'ar' => 'المجموعة الثانية',
                    ],
                    'start_at'    => now()->startOfMonth()->addMonth()->addDays(10),
                    'end_at'      => now()->startOfMonth()->addMonth()->addDays(19),
                ],
                [
                    'name'          => [
                        'en' => 'Third Group',
                        'ar' => 'المجموعة الثالثة',
                    ],
                    'start_at'    => now()->startOfMonth()->addMonth()->addDays(20),
                    'end_at'      => now()->startOfMonth()->addMonth()->addDays(29),
                ]
            ]);
        });
    }
}
