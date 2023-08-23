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
            'total'  => $this->accounts->sum('opening_balance'
                ) + $this->accounts->pluck('journalEntryDetail')->flatten()->sum('credit')
                - $this->accounts->pluck('journalEntryDetail')->flatten()->sum('debit'),

        ];
    }
}
