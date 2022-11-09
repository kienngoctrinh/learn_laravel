<?php

namespace App\Http\Requests\Score;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_code' => [
                'filled',
                'required',
                'string',
                Rule::exists('users', 'code'),
            ],
            'course_code' => [
                'filled',
                'required',
                Rule::exists('courses', 'code'),
            ],
            'point' => [
                'filled',
                'required',
                'numeric',
                'regex:/^(?=.*[1-9])[1-9]{1,8}(?:\.\d{1,2})?$/',
            ],
        ];
    }
}
