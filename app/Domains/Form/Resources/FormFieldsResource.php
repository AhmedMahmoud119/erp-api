<?php

namespace App\Domains\Form\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormFieldsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'form_field_id' => $this->id,
            'field_id' => $this->field->id??null,
            'title' => $this->field->getTranslations('title')??null,
            'type' => $this->field->type??null,
            'some_requirements' => $this->field->some_requirements??null,
            'options' => $this->field->getTranslations('options')??[null],

        ];
    }
}
