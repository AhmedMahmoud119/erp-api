<?php

namespace App\Domains\Group\Resources;

use App\Domains\Account\Resources\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'name_code'       => $this->name.'-'.$this->code,
            'group_type_id' => $this->group_type->id ?? null,
            'group_type_name' => $this->group_type->name ?? null,
            'creator' => $this->creator->name ?? null,
            'children' => AccountResource::collection($this->whenLoaded('accounts')),
            'icon' => $this->icon,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
