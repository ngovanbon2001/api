<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBannerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'image_url' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:8000',
            'sort_order' => 'required|numeric',
        ];   
    }
}
