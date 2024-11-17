<?php

namespace App\Http\Resources\Api\Courses;

use App\Http\Resources\Api\Courses\LessonResource as CoursesLessonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LessonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'desc'               => $this->description,
            'number_of_lessons'  => $this->lessons->count(),
            'time_of_lessons'   => '05:00:00',
            'lessons'            => CoursesLessonResource::collection($this->whenLoaded('lessons')),
        ];
    }
}
