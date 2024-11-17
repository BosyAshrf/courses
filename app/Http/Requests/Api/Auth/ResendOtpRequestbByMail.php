<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterSingleMessageRequest;

class ResendOtpRequestbByMail extends ApiMasterSingleMessageRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
               'email'        => 'required|email|exists:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email'          => __('Email is not correct'),
            'email.exists'         => __('This email already exists'),

        ];
    }
}
