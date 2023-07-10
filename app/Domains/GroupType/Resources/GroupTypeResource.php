<?php

namespace App\Domains\GroupType\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'isFixed'=>$this->is_fixed,
            'code'=>$this->code,
            'creator'=>$this->creator->name??null,

        ];
    }
}
