<?php

namespace App\Domains\Category\Request;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9گچپژیلفقهكيىموي ء-ي\-\p{P}\s]*$/|max:50',
            'description' => 'max:200',
            'parent' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => __('The name contain invalid letters'),
            'name.required' => __('The name field is required'),
            'parent.exists' => __('The parent not exist'),

        ];
    }
}
