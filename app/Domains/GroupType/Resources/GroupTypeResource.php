<?php

namespace App\Domains\GroupType\Resources;

use App\Domains\Group\Resources\GroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'isFixed' => $this->is_fixed,
            'code' => $this->code,
            'creator' => $this->creator->name ?? null,
            'children' => GroupResource::collection($this->whenLoaded('groups')),
            'icon' => $this->icon,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
