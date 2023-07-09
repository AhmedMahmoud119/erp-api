<?php

namespace App\Domains\GroupType\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'type_name'=>$this->type_name,
            'isFixed'=>$this->is_fixed,
            'code'=>$this->code,
            'creator'=>$this->creator->name??null,

        ];
    }
}
