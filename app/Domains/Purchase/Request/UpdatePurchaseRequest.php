<?php

namespace App\Domains\Purchase\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'invoice_number' => 'required|string|max:250',
            'date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_id' => 'required|exists:stocks,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.discount' => 'required|numeric|min:1',
            'taxes' => 'nullable|array',
            'taxes.*.tax_id' => 'exists:taxes,id',
        ];
    }



    public function messages()
    {
        return [
            'quantity.min' => __("The quantity must be one or more ."),
            'date.date' => __('The purchase date  must be in Date format.'),
            'products.required' => __('Add at least on product '),
            'stock_id.required' => __("It's mandatory to choose specific stock."),
            'supplier_id.required' => __("It's mandatory to choose specific purchase supplier."),
            'stock_id.exists' => __("The stock you selected doesn't exist."),
            'supplier_id.exists' => __("The supplier you selected doesn't exist."),
        ];
    }
}
