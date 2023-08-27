<?php

namespace App\Domains\Stock\Request;

use App\Domains\Product\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreStockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'quantity' => 'required|numeric|min:0',
            'opening_stock' => 'required|date',
            'selling_price' => 'numeric|min:1',
            'purchase_price' => 'numeric|min:1',
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required' //|exists:warehouses,id',
        ];
    }
    

    public function messages()
    {
        return [
            'name.regex' => __('The name contain invalid letters.'),
            'opening_stock.date' => __('The opening stock field must be in Date format.'),
            'name.required' => __('The name field is required.'),
            'product_id.required' => __("Its mandatory to choose specific product."),
            'product_id.exists' => __("The product you selected doesn't exist."),

        ];
    }
}
