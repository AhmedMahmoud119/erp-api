<?php

namespace App\Domains\Account\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'code'            => $this->code,
            'name'            => $this->name,
            'group'           => $this->group->name ?? '',
            'group_id'           => $this->group->id ?? '',
            'parent'          => $this->parent->name ?? '',
            'parent_id'          => $this->parent->id ?? '',
            'opening_balance' => $this->opening_balance,
            'account_type'    => $this->account_type,
            'children'       => AccountResource::collection($this->whenLoaded('children')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
