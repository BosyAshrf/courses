<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
        return [
            'image'         => $this->avatar_url,
            'name'          => $this->name,
            'email'         => $this->email,
            'phone_number'  => $this->phone_number,
            'token'         => $this->when($this->token,fn() =>  $this->token),
        ];
    }
}
