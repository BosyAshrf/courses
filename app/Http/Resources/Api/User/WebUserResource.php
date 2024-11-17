<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
        return [
            // 'image' => $this->image ? asset('storage/' . $this->image) : asset('assets/user.png'),
            'full_name'    => $this->full_name,
            'phone_number' => $this->phone_number,
            'email'        => $this->email ?? '',
            'user_type'    => $this->user_type,
            'token'        => $this->when($this->token, $this->token),
            // 'fcm_token'    => $this->when('devices', function () {
            //     return implode(',', $this->devices->pluck('device_token')->toArray());
            // }),
        ];
    }
}
