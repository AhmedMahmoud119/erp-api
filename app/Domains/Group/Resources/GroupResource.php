<?php

namespace App\Domains\Group\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'group_type_id'=>$this->group_type->id??null,
            'group_type_name'=>$this->group_type->type_name??null,
            'creator'=>$this->creator->name??null,
            'created_at'=>$this->created_at->format('Y-m-d'),

        ];
    }
}
