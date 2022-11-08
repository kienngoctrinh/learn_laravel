<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => [
                'filled',
                'required',
                'string',
                'max:255',
                'unique:App\Models\User,code',
            ],
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
                'string',
            ],
            'password' => [
                'filled',
                'required',
                'string',
                'min:6',
                'max:255',
            ],
            'role' => [
                'filled',
                'required',
            ],
        ];
    }
}
