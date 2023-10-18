<?php

namespace App\Domains\Account\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountParentsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'code'            => $this->code,
            'name'            => $this->name,
            'name_code'       => $this->name.'-'.$this->code,
        ];
    }
}
