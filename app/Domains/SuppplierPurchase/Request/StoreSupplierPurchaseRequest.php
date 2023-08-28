<?php

namespace App\Domains\SupplierPurchase\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreSupplierPurchaseRequest extends FormRequest
{
    protected $product;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'invoice_number' => 'required|string|max:250',
            'quantity' => 'required|numeric|min:1',
            'date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_id' => 'required|exists:stocks,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.discount' => 'required|decimal:2',

        ];
    }


    public function messages()
    {
        return [
            'quantity.min' => __("The quantity must be one or more ."),
            'date.date' => __('The purchase date  must be in Date format.'),
            'product_id.required' => __("It's mandatory to choose the product."),
            'products.required' => __('Add at least on product '),
            'stock_id.required' => __("It's mandatory to choose specific stock."),
            'supplier_id.required' => __("It's mandatory to choose specific purchase supplier."),
            'product_id.exists' => __("The product you selected doesn't exist."),
            'stock_id.exists' => __("The stock you selected doesn't exist."),
            'supplier_id.exists' => __("The supplier you selected doesn't exist."),
            'decimal' => __('The field must be decimal and in format 00.00'),

        ];
    }
}