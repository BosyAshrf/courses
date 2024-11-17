<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerifyResource extends JsonResource
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
            'avatar' => $this->avatar_url,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'email' => $this->email ?? '',
            'token' => $this->when($this->token, $this->token),
        ];
    }
}
