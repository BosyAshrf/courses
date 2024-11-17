<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Enums\Course\Type;
use App\Models\Expert;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Level;
use App\Enums\Course\Status;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = collect(json_decode(file_get_contents(database_path('data/courses.json')), true));
        $offer = rand(0, 1);
        $image = Storage::disk('public')->putFile('courses', new UploadedFile(public_path('assets/images/people/5.png'), '5.png'));

        $courses->each(function ($course) use ($offer, $image) {

            Course::create([
                'title'         => $course['title'],
                'subtitle'      => $course['subtitle'],
                'description'   => ['en' => fake()->paragraph(), 'ar' => fake('ar_SA')->realText(500)],
                'image'         => $image,
                'category_id'   => $course['category_id'],
                'price'         => fake()->randomFloat(2, 50, 100),
                'offer_price'   => $offer ? fake()->randomFloat(2, 10, 50) : 0,
                'type'          => fake()->randomElement([Type::RECORDED, Type::ONLINE, Type::OFFLINE]),
                'status'        => Status::PUBLISHED,
            ]);
        });
    }
}
