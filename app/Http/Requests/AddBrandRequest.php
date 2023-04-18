<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'link' => 'required',
            'image_url' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:8000',
            'sort_order' => 'required|numeric',
        ];
    }
}
