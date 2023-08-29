<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'groups' => GroupsBalanceSheetResource::collection($this->groups),
            'total'  => $this->groups->pluck('accounts')->flatten()->sum('opening_balance') +
                $this->groups->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit') -
                $this->groups->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit'),
        ];
    }
}
