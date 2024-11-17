<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'email' => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users,email',
            'phone_number'  => 'required|digits:12|unique:users,phone_number,' . auth('api')->id(),
            'password' => 'required|confirmed|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'phone_number.required' => __('Phone is required'),
            'phone_number.unique' => __('This phone already exists'),
            'phone_number.regex' => __('Phone validation'),
            'phone_number.digits' => __('This phone number must not be less than 12 number'),
            'password.required' => __('Password is required'),
            'password.same' => __('Password Confirmation should match the Password'),
            'password.regex' => __('Password validation'),
            'email.email' => __('Email is not correct'),
            'email.unique' => __('This email already exists'),
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors()->toArray();

    //     $response = [
    //         'status'  => 'fail',
    //         'message' => 'Validation error',
    //         'errors'  => $errors,
    //     ];

    //     throw new HttpResponseException(response()->json($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    // }
}
