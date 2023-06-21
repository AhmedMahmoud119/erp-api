<?php

namespace App\Domains\Form\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormVersionsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'form_id' => $this->form_id,
            'user_id' => $this->user_id,
            'version' => $this->user_id,
            'updated_at' => $this->updated_at?->format('Y-m-d'),

        ];
    }
}
