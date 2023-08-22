<?php

namespace App\Domains\Vendor\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => [$this->country->id, $this->country->name],
        ];
    }
}