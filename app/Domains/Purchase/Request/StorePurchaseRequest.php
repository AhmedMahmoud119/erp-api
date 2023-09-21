<?php

namespace App\Domains\Purchase\Request;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{

    protected $product;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'invoice_number'        => 'required|string|max:250',
            'date'                  => 'required|date',
            'supplier_id'           => 'nullable|exists:suppliers,id',
            'vendor_id'             => 'nullable|exists:vendors,id',
            'customer_id'           => 'nullable|exists:customers,id',
            'stock_id'              => 'required|exists:stocks,id',
            'products'              => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|numeric|min:1',
            'products.*.discount'   => 'required|numeric|min:0',
            'taxes'                 => 'nullable|array',
            'taxes.*.tax_id'        => 'exists:taxes,id',
        ];
    }

    public function messages()
    {
        return [
            'quantity.min'          => __("The quantity must be one or more ."),
            'date.date'             => __('The purchase date  must be in Date format.'),
            'products.required'     => __('Add at least on product '),
            'products.*.product_id' => __('wrong product'),
            'products.*.quantity'   => __('wrong quantity'),
            'products.*.discount'   => __('wrong discount'),
            'stock_id.required'     => __("It's mandatory to choose specific stock."),
            'supplier_id.required'  => __("It's mandatory to choose specific purchase supplier."),
            'stock_id.exists'       => __("The stock you selected doesn't exist."),
            'supplier_id.exists'    => __("The supplier you selected doesn't exist."),
        ];
    }
}
