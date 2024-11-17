<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
        ];
    }

    public function weekNum($index)
    {
        $index = $index + 1;
        return match($index){
            1       => __('First week'),
            2       => __('Second week'),
            3       => __('Third week'),
            4       => __('Fourth week'),
            5       => __('Fifth week'),
            6       => __('Sixth week'),
            7       => __('Seventh week'),
            8       => __('Eighth week'),
            9       => __('Ninth week'),
            10      => __('Tenth week'),
            default => __('Week :num',['num' => $index]),
        };
    }
}
