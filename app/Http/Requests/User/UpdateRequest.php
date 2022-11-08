<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                Rule::unique(User::class)->ignore($this->user),
            ],
            'email' => [
                'filled',
                'required',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user),
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
            'role' => [
                'filled',
                'required',
            ],
            'avatar' => [
                'filled',
                'required',
                'image',
                'max:2048',
            ],
        ];
    }
}
