<?php

namespace App\Domains\Field\Rules;

use Illuminate\Contracts\Validation\Rule;

class LangKeysRule implements Rule
{

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        return   is_array($value) && count(array_diff(array_keys($value), [0]))==count(array_values($value));
    }

    public function message()
    {
        return __('You Must Add Lang in :attribute');
    }
}
