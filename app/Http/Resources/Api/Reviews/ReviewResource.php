<?php

namespace App\Http\Resources\Api\Reviews;

use App\Http\Resources\Api\Products\ProductIndexResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            // 'product' => new ProductIndexResource($this->product),
            'user_name' => User::where('id', $this->user_id)->first()->full_name,
            'rating' => $this->rating ?? 0.0 ,
            'comment' => $this->comment,
            
        ];
    }
}
