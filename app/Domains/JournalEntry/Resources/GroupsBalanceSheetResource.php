<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupsBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'accounts' => AccountsBalanceSheetResource::collection($this->accounts),
        ];
    }
}
