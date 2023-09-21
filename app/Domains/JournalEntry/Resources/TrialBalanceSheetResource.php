<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TrialBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'accounts' => AccountsTrialBalanceSheetResource::collection($this),
            'total_credit' => $this->pluck('journalEntryDetail')->flatten()->sum('credit'),
            'total_debit' => $this->pluck('journalEntryDetail')->flatten()->sum('debit'),

        ];
    }
}
