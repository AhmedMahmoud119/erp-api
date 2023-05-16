<?php

namespace App\Domains\Field\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
