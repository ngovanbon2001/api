<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required',
            'image_url' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:8000',
            'price' => 'required|numeric',
            'sort_order' => 'required|numeric'
        ];
    }
}
