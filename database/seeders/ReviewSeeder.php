<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'user_id' => User::factory()->create()->id,
                'course_id' => Course::factory()->create()->id,
                'star' => rand(1, 5),
                'comment' => 'The instructor was very knowledgeable and the course was well-paced.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => User::factory()->create()->id,
                'course_id' => Course::factory()->create()->id,
                'star' => rand(1, 5),
                'comment' => 'The course content was comprehensive and well-structured, making it easy to follow and understand.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('reviews')->insert($reviews);
    }
}
