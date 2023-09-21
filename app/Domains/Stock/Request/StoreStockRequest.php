<?php

namespace App\Domains\Stock\Request;

use App\Domains\Product\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreStockRequest extends FormRequest
{
    protected $product;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'quantity' => 'required|numeric|min:1',
            'opening_stock' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'purchasing_price' => 'required|numeric|min:1',
            'selling_price' => 'required|numeric|min:1',
        ];
    }


    public function messages()
    {
        return [
            'min' => __("The field must be one or more ."),
            'opening_stock.date' => __('The opening stock field must be in Date format.'),
            'opening_stock.required' => __('The opening stock field is required.'),
            'product_id.required' => __("It's mandatory to choose specific product."),
            'warehouse_id.required' => __("It's mandatory to choose specific warehouse."),
            'product_id.exists' => __("The product you selected doesn't exist."),
            'warehouse_id.exists' => __("The warehouse you selected doesn't exist."),

        ];
    }
}