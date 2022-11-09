<?php

namespace App\Http\Requests\Score;

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
            'user_id' => [
                'required',
                'unique:App\Models\Score,id',
            ],
            'point' => [
                'required',
                'numeric',
            ],
        ];
    }
}
