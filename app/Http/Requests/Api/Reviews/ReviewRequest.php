<?php

namespace App\Http\Requests\Api\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id'  => ['required', 'exists:courses,id'],
            'rating'     => ['required' , 'numeric'],
            'comment'    => ['nullable' , 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'course_id.required' => 'Course ID is required',
            'course_id.exists'   => 'Course ID does not exist',
            'rating.required'    => 'Rating is required',
            'rating.numeric'     => 'Rating must be a number',
            'comment.string'     => 'Comment must be a string',
        ];
    }
}
