<?php

namespace App\Http\Controllers\Api\Courses;

use App\Enums\Api\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Courses\CourseDetailsResource;
use App\Http\Resources\Api\Courses\IndexCourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::Published()->search()->filters()->paginate(10);

        return generalApiResponse(ResponseMethodEnum::CUSTOM_COLLECTION,custom_message: __('Data Returned Successfully'), resource: IndexCourseResource::class, data_passed: $course);
    }

    public function show($id)
    {
        $course = Course::Published()->find($id);

        if (!$course) {
            return generalApiResponse(ResponseMethodEnum::CUSTOM,custom_message: __('Course Not Found'));
        }

        return generalApiResponse(ResponseMethodEnum::CUSTOM_SINGLE,custom_message: __('Data Returned Successfully'), resource: CourseDetailsResource::class, data_passed: $course);
    }
}
