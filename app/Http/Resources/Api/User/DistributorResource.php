<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Companies\SimpleCompanyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image'        => $this->image ? asset('storage/' . $this->image) : asset('images/user.png'), 
            'full_name'    => $this->full_name,
            'phone_number' => $this->phone_number,
            'email'       => $this->email ?? '',
            'user_type'  => $this->user_type,
            'token'     => $this->when($this->token, $this->token),
            'location'  => $this->getTranslation('location', app()->getLocale()),
            'company' => new SimpleCompanyResource($this->company),
            'min_price' => $this->min_price,
            'is_approved' => true,
        ];
    }
}
