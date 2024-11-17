<?php

namespace Database\Seeders;

use App\Enums\Course\Type;
use Illuminate\Database\Seeder;
use App\Models\Course;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::where('type',Type::RECORDED)->get()->each(function ($course){
            $course->sections()->create([
                'title' => [
                    'en' => 'Intro',
                    'ar' => 'مقدمة',
                ],
                'description' => [
                    'en' => 'Intro to the course',
                    'ar' => 'مقدمة للدورة',
                ],
            ]);
            $course->sections()->create([
                'title' => [
                    'en' => 'Chapter 1',
                    'ar' => 'الفصل الأول',
                ],
                'description' => [
                    'en' => 'Chapter 1 of the course',
                    'ar' => 'الفصل الأول من الدورة',
                ],
            ]);
            $course->sections()->create([
                'title' => [
                    'en' => 'Chapter 2',
                    'ar' => 'الفصل الثاني',
                ],
                'description' => [
                    'en' => 'Chapter 2 of the course',
                    'ar' => 'الفصل الثاني من الدورة',
                ],
            ]);
        });
    }
}
