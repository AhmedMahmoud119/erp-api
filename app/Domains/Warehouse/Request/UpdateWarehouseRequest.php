<?php

namespace App\Domains\Warehouse\Request;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWarehouseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'description' => 'required',
            'address'     => 'required|max:200',
            'assigned_id' => 'required|exists:users,id',
            'state_id'    => 'required|exists:states,id',
            'country_id'  => 'required|exists:countries,id',
            'city_id'     => 'required|exists:cities,id',
            'zip_code'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => __('The name field is required'),
            'name.regex'           => __('The name must only contain letters'),
            'description.required' => __('The description field is required'),
            'address_id.required'  => __('The address field is required'),
        ];
    }
}
