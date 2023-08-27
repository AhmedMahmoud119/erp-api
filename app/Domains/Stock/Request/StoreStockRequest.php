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
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'selling_price' => 'nullable|numeric|min:1',
            'purchasing_price' => 'nullable|numeric|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $productId = $this->input('product_id');
            $product = Product::find($productId);

            // case will never be happen => the product fields dosen't nullable
            if (!$product || empty($product->selling_price)) {
                $validator->errors()->add('selling_price', 'The product selling price must be inserted.');
            } else if (empty($product->purchase_price)) {
                $validator->errors()->add('purchasing_price', 'The product purchase price must be inserted.');
            }
        });
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
