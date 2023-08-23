<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfitLossResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'accounts' => AccountsBalanceSheetResource::collection($this->groups->pluck('accounts')->flatten()),

            'total'  => $this->groups->pluck('accounts')->flatten()->sum('opening_balance')
                + $this->groups->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit')
                - $this->groups->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit'),
        ];
    }
}
