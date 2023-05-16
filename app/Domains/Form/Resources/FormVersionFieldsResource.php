<?php

namespace App\Domains\Form\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormVersionFieldsResource extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'form_version_id' => $this->id,
            'form_id' => $this->form_id,
            'version' => $this->version,
            'form_name' => $this->form->title,
            'last_update' => $this->updated_at->format('Y-m-d'),
            'fields' => FormFieldsResource::collection($this->fields),
        ];
    }
}
