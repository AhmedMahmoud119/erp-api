<?php

namespace App\Domains\Account\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'code'            => $this->code,
            'name'            => $this->name,
            'group'           => $this->group->name??'',
            'parent'          => $this->parent->name??'',
            'opening_balance' => $this->opening_balance,
            'account_type'    => $this->account_type,
        ];
    }
}
