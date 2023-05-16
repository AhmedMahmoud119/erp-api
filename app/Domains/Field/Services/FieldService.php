<?php

namespace App\Domains\Field\Services;

use App\Domains\Field\Interfaces\FieldRepositoryInterface;
use App\Domains\Field\Models\EnumFieldTypes;

class FieldService
{
    public function __construct(private FieldRepositoryInterface $fieldRepository)
    {
    }
    public function list()
    {
        return $this->fieldRepository->list();
    }
    public function findById($id)
    {
        return $this->fieldRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->fieldRepository->delete($id);
    }

    public function create($request)
    {
        return $this->fieldRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->fieldRepository->update($id,$request);
    }
    public function listFieldTypes()
    {
//        $fieldTypes = array_column(EnumFieldTypes::cases(), 'value');
        $fieldTypes = [
            [
                'type' => EnumFieldTypes::text->value,
                'icon' => asset('icons/text.svg'),
            ],
            [
                'type' => EnumFieldTypes::checkbox->value,
                'icon' => asset('icons/Checkbox.svg'),
            ],
            [
                'type' => EnumFieldTypes::radioButton->value,
                'icon' => asset('icons/RadioButton.svg'),
            ],
            [
                'type' => EnumFieldTypes::fileUpload->value,
                'icon' => asset('icons/FileUpload.svg'),
            ],
            [
                'type' => EnumFieldTypes::rating->value,
                'icon' => asset('icons/Rating.svg'),
            ],
            [
                'type' => EnumFieldTypes::dropdown->value,
                'icon' => asset('icons/text.svg'),
            ],
            [
                'type' => EnumFieldTypes::textArea->value,
                'icon' => asset('icons/Textarea.svg'),
            ],
            [
                'type' => EnumFieldTypes::toggleSwitch->value,
                'icon' => asset('icons/toggle-on.svg'),
            ],
            [
                'type' => EnumFieldTypes::timePicker->value,
                'icon' => asset('icons/TimePicker.svg'),
            ],
            [
                'type' => EnumFieldTypes::image->value,
                'icon' => asset('icons/Image.svg'),
            ],
            [
                'type' => EnumFieldTypes::label->value,
                'icon' => asset('icons/Label.svg'),
            ],
            [
                'type' => EnumFieldTypes::number->value,
                'icon' => asset('icons/NumberField.svg'),
            ],
        ];
        return $fieldTypes;
    }

}
