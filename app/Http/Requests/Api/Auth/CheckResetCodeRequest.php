<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;
use App\Http\Requests\Api\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckResetCodeRequest extends FormRequest
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
        $code = 'required|' . Rule::exists('users', 'otp')->where(function ($query) {
            return $query->where('phone_number', $this->phone_number);
        });
        return [
            'phone_number' => 'required|exists:users,phone_number',
            'code'         => $code,
        ];

    }

    public function messages(): array
    {
        return [
            'phone_number.numeric' => __('Phone is required'),
            'phone_number.exists'  => __('Phone is not exists'),
            'code.exists'          => __('Code is not exists'),
            'code.required'        => __('Code is required'),
        ];
    }
}
