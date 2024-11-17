<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Http\Requests\Api\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class ResendOtpRequest extends FormRequest
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
            'phone_number' => 'required|digits:12' . auth('api')->id(),
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.numeric' => __('Phone is required'),
            'phone_number.regex'   => __('Please enter a valid phone number format.'),
        ];
    }
}
