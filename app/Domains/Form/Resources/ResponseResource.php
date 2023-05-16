<?php

namespace App\Domains\Form\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{

    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'value' => $this->value,
            'field_title' => $this->formField->field->getTranslations('title'),
            'field_id' => $this->formField->field->id,
            'field_type' => $this->formField->field->type,
            'form_field_id' => $this->formField->id,
        ];
    }
}
