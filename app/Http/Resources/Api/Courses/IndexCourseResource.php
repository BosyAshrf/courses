<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexCourseResource extends JsonResource
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
        ];
    }
}
