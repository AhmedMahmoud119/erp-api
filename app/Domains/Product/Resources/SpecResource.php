<?php

namespace App\Domains\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->pivot->value,
        ];
    }
}
