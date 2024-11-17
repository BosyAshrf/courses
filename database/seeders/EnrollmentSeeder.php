<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
        ]);

        $users = User::all();
        $courses = Course::all();

        $users->each(function ($user) use ($courses) {
            $user->enrollments()->attach(
                $courses->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
