<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'total_money' => 'required|numeric',
            'total_products' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
        ];
    }
}
