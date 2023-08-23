<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'assets' => new BalanceSheetResource($this['assets']),
            'liabilities' => new BalanceSheetResource($this['liabilities']),
            'equity' => new BalanceSheetResource($this['equity']),
            'liabilities_plus_equity' =>
                $this['equity']?->groups?->pluck('accounts')->flatten()->sum('opening_balance') +
                $this['equity']?->groups?->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit') -
                $this['equity']?->groups?->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit') +
                $this['liabilities']?->groups?->pluck('accounts')->flatten()->sum('opening_balance') +
                $this['liabilities']?->groups?->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('credit') -
                $this['liabilities']?->groups?->pluck('accounts')->flatten()->pluck('journalEntryDetail')->flatten()->sum('debit')
            ,
        ];
    }
}
