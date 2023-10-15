<?php

namespace App\Domains\FixedAsset\Request;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreFixedAssetRequest extends FormRequest
{
    private $parentType;
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9گچپژیلفقهكيىموي ء-ي\s\-_]*$/',
            'description' => 'regex:/^[a-zA-Z0-9گچپژیلفقهكيىموي ء-ي\s\-_]*$/',
            'acquisition_date' => 'required|date',
            'acquisition_value' => 'required|numeric|min:0',
            'depreciation_value' => 'required|numeric|min:0',
            'depreciation_ratio' => 'numeric',
            'depreciation_duration_type' => 'required|in:month,year',
            'depreciation_duration_value' => 'required|integer|min:1',
            'parent_id' => 'required',
            'parent_code' => 'required',
        ];

    }
    public function withValidator($validator)
    {
        //validate code matching with id && apend parent_type to Request
        $validator->after(function ($validator) {
            if (Str::length($this->parent_code) === 8) {
                $result = Account::where('id', $this->parent_id)
                    ->where('code', $this->parent_code)
                    ->exists();
            } elseif (Str::length($this->parent_code) === 4) {
                $result = Group::where('id', $this->parent_id)
                    ->where('code', $this->parent_code)
                    ->exists();
            } else {
                $validator->errors()->add('parent_code', 'The parent code is incorrect.');
                return;
            }
            if (!$result) {
                $validator->errors()->add('parent_code', 'The parent code does not match the specified parent id, Or may be does not exist.');
            }
        });
    }
    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.regex' => __('The name contains invalid letters'),
            'description.regex' => __('Description field contains invalid letters'),
        ];

    }
}
