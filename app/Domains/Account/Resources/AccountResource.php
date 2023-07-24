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
            'group'           => $this->group->name??'',
            'group_id'           => $this->group->id??'',
            'parent'          => $this->parent->name??'',
            'parent_id'          => $this->parent->id??'',
            'opening_balance' => $this->opening_balance,
            'account_type'    => $this->account_type,
        ];
    }
}
