<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'description' => $this->description,
            'video'    => $this->video_url,
            'duration' => $this->duration,
        ];
    }
}

