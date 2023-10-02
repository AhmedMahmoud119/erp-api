<?php

namespace App\Domains\FixedAsset\Request;

use Illuminate\Foundation\Http\FormRequest;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;

class UpdateFixedAssetRequest extends FormRequest
{

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
            'acquisition_value' => 'required|integer|min:0',
            'depreciation_value' => 'required|integer|min:0',
            'depreciation_ratio' => 'numeric',
            'depreciation_duration_type' => 'required|in:day,month,year',
            'depreciation_duration_value' => 'required|integer|min:1',
            'parent_id' => 'required',
            'parent_code' => 'required' ,
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $accountExists = Account::where('code', $this->parent_code)->exists();
            $groupExists = Group::where('code', $this->parent_code)->exists();

            if ($accountExists) {
                $this->parentType = 'account';
                $result = Account::where('id', $this->parent_id)
                    ->where('code', $this->parent_code)
                    ->exists();
            } elseif ($groupExists) {
                $this->parentType = 'group';
                $result = Group::where('id', $this->parent_id)
                    ->where('code', $this->parent_code)
                    ->exists();
            } else {
                $validator->errors()->add('parent_code', 'The parent code does not match the specified parent id, Or may be does not exist.');
                return;
            }
            if ($result) {
                $this->merge(['parent_type' => $this->parentType]);
            } else {
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
