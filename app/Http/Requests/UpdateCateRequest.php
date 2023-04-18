<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'sort_order' => 'required|numeric',
        ];
    }
}
