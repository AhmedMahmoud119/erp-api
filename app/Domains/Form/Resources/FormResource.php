<?php

namespace App\Domains\Form\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'last_version_id' => $this->last_version_id,
            'updated_at' => $this->updated_at?->format('Y-m-d'),
            'form_versions'=> FormVersionsResource::collection($this->formVersions),


        ];
    }
}
