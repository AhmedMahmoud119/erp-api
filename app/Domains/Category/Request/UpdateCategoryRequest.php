<?php

namespace App\Domains\Category\Request;

use App\Domains\Category\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'parent_id' => [
                'nullable',
                'exists:categories,id',
                Rule::notIn([$this->route('id')]),
            ],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $parentId = $this->input('parent_id');
            $category = Category::find($this->route('id'));
            $category->load('descendants');
            $descendantIDs = $this->gitDescendantIds($category);
            if (in_array($parentId, $descendantIDs)) {
                $validator->errors()->add('parent_id', 'The selected parent category cannot be one of its childs.');
            }
        });
    }
    protected function gitDescendantIds($category)
    {
        $descendantIDs = [];
        foreach ($category->descendants as $descendant) {
            $descendantIDs[] = $descendant->id;
            $descendantIDs = array_merge($descendantIDs, $this->gitDescendantIds($descendant));
        }
        return $descendantIDs;
    }

    public function messages()
    {
        return [
            'name.regex' => __('The name contain invalid letters'),
            'name.required' => __('The name field is required'),
            'parent_id.exists' => __('The parent not exist'),
            'parent_id.not_in' => __('The Category should not belongs to itself'),

        ];
    }
}