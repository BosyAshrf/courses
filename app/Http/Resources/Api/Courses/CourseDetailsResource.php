<?php

namespace App\Http\Resources\Api\Courses;

use App\Http\Resources\Api\Courses\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'img' => $this->image_url,
            'type' => $this->type->title(),
            'status' => $this->status,
            'status_translated' => $this->status_translated,
            'video' => $this->video_url,
            'cover' => $this->preview_cover_url,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'category' => CategoryResource::make($this->category),
            'sections' => SectionResource::collection($this->sections),
            'lessons' => LessonResource::collection($this->lessons),
            'groups' => GroupResource::collection($this->groups),
        ];
    }
}
