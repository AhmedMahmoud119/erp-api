<?php

namespace App\Domains\Permission\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use \Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
        ];
    }
}
