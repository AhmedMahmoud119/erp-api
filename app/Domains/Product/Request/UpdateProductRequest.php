<?php

namespace App\Domains\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required|regex:/^[a-zA-Z0-9\-\,\.\s]+$/',
            'name' => 'required|max:100',
            'description' => 'max:500',
            'quantity' => 'required|numeric',
            'opening_stock' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',

            'category_id' => 'required|exists:categories,id',
            'taxes_id' => 'required|exists:taxes,id',
            'unit_id' => 'required|exists:unit_types,id',
            'specs' => 'required|array',
            'specs.*.name' => 'required',
            'specs.*.value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => __('category field is required'),
            'category_id.exists' => __('The selected category does not exist'),
            'taxes_id.required' => __('taxes field is required'),
            'unit_id.required' => __('units field is required'),
            'decimal' => __('The field must be decimal and in format 00.00'),
            'specs.required' => __('Add at least on product specification'),
        ];
    }
}
