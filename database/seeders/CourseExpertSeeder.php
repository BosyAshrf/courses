<?php

namespace Database\Seeders;

use App\Models\CourseExpert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        runSeeder('course_experts', 'course_expert', CourseExpert::class);
    }
}
