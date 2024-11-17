<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Http\Requests\Api\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
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
            'phone_number' => ['required','digits:12','exists:users,phone_number'],
            'password'     => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required'=> __('Phone number is required'),
            'phone_number.exists'  => __('Phone number does not exist'),
            'phone_number.digits'  => __('This phone number must not be less than 12 number'),
            'password.required'    => __('Password is required'),
        ];
    }
}
