<?php

namespace App\Domains\Vendor\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'state' => [$this->state->id , $this->state->name],
            'country' => [$this->country->id, $this->country->name],
        ];
    }
}
