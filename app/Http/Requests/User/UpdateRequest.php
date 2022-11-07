<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'filled',
                'required',
                'email',
                'max:255',
                'unique:App\Models\User,email',
            ],
            'name' => [
                'filled',
                'required',
                'string',
                'max:255',
            ],
            'birthday' => [
                'filled',
                'required',
                'date',
                'before:today',
            ],
            'gender' => [
                'filled',
                'required',
                'boolean',
            ],
            'programming_language' => [
                'filled',
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
