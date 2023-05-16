<?php

namespace App\Domains\Form\Rules;

use App\Domains\Field\Models\EnumFieldTypes;
use App\Domains\Field\Models\EnumSomeRequirements;
use App\Domains\Form\Models\FieldResponse;
use App\Domains\Form\Models\FormField;
use App\Domains\Form\Models\FormVersion;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Route;

class CheckFormFields implements Rule
{

    public $errors = [];

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {

        $formVersion = FormVersion::with([
            'fields' => function($q){
                $q->where('hidden',0);
            }
        ])->where('form_id', Route::input('id'))->orderBy('id', 'desc')->first();

        $formVersionFields = $formVersion->fields ?? collect();

        $checkFormVersionFieldsExists = array_diff(array_keys($value), $formVersionFields->pluck('id')->toArray());

        if (!empty($checkFormVersionFieldsExists)) {
            $this->errors[] = __('messages.some_fields_not_exists_in_this_form_version');
        }

        foreach ($formVersionFields as $formVersionField) {

            if (in_array(EnumSomeRequirements::required->value, $formVersionField->field->some_requirements)
                && !isset($value[$formVersionField->id])) {
                $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.required');
            } else if (in_array(EnumSomeRequirements::unique->value, $formVersionField->field->some_requirements)) {
                $fieldResponse = FieldResponse::where([
                    'form_field_id' => $formVersionField->id,
                    'value' => $value[$formVersionField->id],
                ])->first();

                if ($fieldResponse) {
                    $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.must_be_unique');
                }
            }

            if ($formVersionField->field->type == EnumFieldTypes::fileUpload->value) {
                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'pdf', 'csv', 'xlsx', 'doc', 'docx');
                $filename = $_FILES['value']['name'][$formVersionField->id] ?? null;
                $this->checkType($filename, $allowed, $formVersionField);
            } elseif ($formVersionField->field->type == EnumFieldTypes::image->value) {
                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                $filename = $_FILES['value']['name'][$formVersionField->id] ?? null;
                $this->checkType($filename, $allowed, $formVersionField);
            } elseif ($formVersionField->field->type == EnumFieldTypes::checkbox->value) {
                if (isset($value[$formVersionField->id])&&!is_array($value[$formVersionField->id]??'')) {
                    $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.must_be_array');
                }
            } elseif (($formVersionField->field->type == EnumFieldTypes::rating->value) || ($formVersionField->field->type == EnumFieldTypes::number->value)) {
                if (!is_numeric($value[$formVersionField->id])) {
                    $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.must_be_number');
                }
            } else {
                if (isset($value[$formVersionField->id]) && !is_string($value[$formVersionField->id])) {
                    $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.must_be_string');
                }
            }

        }

        return empty($this->errors) ? true : false;

    }

    public function checkType($filename, $allowed, $formVersionField)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $this->errors[] = __('messages.field') . ' ' . $formVersionField->field->title . ' ' . __('messages.must_be_file_of_type')
                . ' ' . implode(',', $allowed);
        }
    }

    public function message()
    {
        return $this->errors;
    }
}
