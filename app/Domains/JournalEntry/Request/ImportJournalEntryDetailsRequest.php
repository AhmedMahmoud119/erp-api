<?php

namespace App\Domains\JournalEntry\Request;

use Illuminate\Foundation\Http\FormRequest;

class ImportJournalEntryDetailsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:xlsx,csv,txt,xls',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'Please upload file',
            'file.mimes' => 'Please upload file in .xlsx, .csv, .txt, .xls format',
        ];
    }
}
