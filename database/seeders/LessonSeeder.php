<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use Illuminate\Support\Facades\Process;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $source = public_path('assets/images/lessons/lesson.mp4');
        $dist   = storage_path('app/public/lesson.mp4');
        $result = Process::run("cp $source $dist");
        if($result->failed()){
            $this->command->error($result->errorOutput());
        }
        Section::all()->each(function ($section){
            $section->lessons()->create([
                'name' => [
                    'en' => 'first lesson',
                    'ar' => 'الدرس الأول'
                ],
                'video' => [
                    'disk' => 'public',
                    'path' => 'lesson.mp4',
                ],
            ]);
            $section->lessons()->create([
                'name' => [
                    'en' => 'second lesson',
                    'ar' => 'الدرس الثاني'
                ],
                'video' => [
                    'disk' => 'public',
                    'path' => 'lesson.mp4',
                ],
            ]);
            $section->lessons()->create([
                'name' => [
                    'en' => 'third lesson',
                    'ar' => 'الدرس الثالث'
                ],
                'video' => [
                    'disk' => 'public',
                    'path' => 'lesson.mp4',
                ],
            ]);
        });
    }
}
