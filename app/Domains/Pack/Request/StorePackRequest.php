<?php

namespace App\Domains\Pack\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'name' => 'required|max:200',
            'description' => 'max:500',
            'material' => 'required|max:200',
            'quantity' => 'required|numeric|min:1',

            'price' => 'required|numeric|min:0',

            'weight' => 'required|numeric|min:0',
            'width' => 'required|numeric|min:0',
            'length' => 'required|numeric|min:0',
            'height' => 'required|numeric|min:0',

            'products' => 'required|array',
            'products.*' => 'required|numeric|exists:products,id',

        ];
    }

    public function messages()
    {
        return [
            'products.required' => __('At least add one product '),
            'product_id.exists' => __('The selected product does not exist'),
            'decimal' => __('The field must be number and in format 00.00'),
            'quantity.numeric' => __('The field must be positive number'),
        ];
    }
}
