<?php

namespace App\Domains\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'selling_price' => 'required|decimal:2',
            'purchase_price' => 'required|decimal:2',

            'category_id' => 'required|exists:categories,id',
            'taxes_id' => 'required|exists:taxes,id',
            'unit_id' => 'required|exists:unit_types,id',
            'specs.*.spec_id' => 'required|exists:specs,id',
        ];
    }
    public function withValidator($validator)
    {
        $specs = request()->specs;
        $validator->after(function ($validator) use ($specs) {
            $unique = collect(request()->specs)->unique('spec_id');
            if ($unique->count() != count($specs)) {
                $validator->errors()->add('specs', __('validation.specs.unique'));
            }
        });

    }

    public function messages()
    {
        return [
            'category_id.required' => __('category field is required'),
            'category_id.exists' => __('The selected category does not exist'),
            'taxes_id.required' => __('taxes field is required'),
            'unit_id.required' => __('units field is required'),
            'decimal' => __('The field must be decimal and in format 00.00'),
            'specs' => __('validation.specs.unique')
        ];
    }
}