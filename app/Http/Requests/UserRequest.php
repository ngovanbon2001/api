<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'email' => 'required|max:255|unique:Users',
            'password' => 'required|min:5',
            'phone' => 'required|numeric'
        ];
    }
}
