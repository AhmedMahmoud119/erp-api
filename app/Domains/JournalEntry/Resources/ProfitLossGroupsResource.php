<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfitLossGroupsResource extends JsonResource
{

    public function toArray($request)
    {
        $revenue = $this->where('code',4)->pluck('groups')->flatten()->pluck('accounts')->flatten()->sum('opening_balance')
        + $this->where('code',4)->pluck('groups')->flatten()->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit')
        - $this->where('code',4)->pluck('groups')->flatten()->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit');

        $expenses = $this->where('code',5)->pluck('groups')->flatten()->pluck('accounts')->flatten()->sum('opening_balance')
            + $this->where('code',5)->pluck('groups')->flatten()->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit')
            - $this->where('code',5)->pluck('groups')->flatten()->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit');
        return [
            'net'  => $revenue-$expenses,

            'groups' => ProfitLossResource::collection($this),
        ];
    }
}
