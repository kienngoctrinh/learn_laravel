<?php

namespace App\Http\Requests\Score;

use App\Models\Score;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth();
    }

    public function rules()
    {
        return [
            'point' => [
                'filled',
                'required',
                'numeric',
                'regex:/^(?=.*[1-9])\d{1,6}(?:\.\d{1,2})?$/',
            ],
        ];
    }
}
