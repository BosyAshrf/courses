<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Http\Requests\Api\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class SendResetPasswordCodeRequest extends FormRequest
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
            'phone_number' => 'required|exists:users,phone_number',
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.numeric' => __('Phone is required'),
            'phone_number.exists' => __('Phone is not exists'),
        ];
    }

}
