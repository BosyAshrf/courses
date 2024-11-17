<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleDistributorResource extends JsonResource
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
            'distance' => round($this->distance, 2),
            'name' => $this->full_name,
            'location' => $this->location,
            'origin_lat' => $this->origin_lat,
            'origin_lng' => $this->origin_lng,
            'trip_id' => $this->trip_id,
        ];
    }
   

}
