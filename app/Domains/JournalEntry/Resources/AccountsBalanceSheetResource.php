<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountsBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'      => $this->id,
            'code'    => $this->code,
            'name'    => $this->name,
            'total' => $this->opening_balance + $this->journalEntryDetail->sum('credit') - $this->journalEntryDetail->sum('debit'),
//            'opening_balance' => $this->opening_balance,
//            'journalEntryDetailBalanceCredit' => $this->journalEntryDetail->sum('credit'),
//            'journalEntryDetailBalanceDebit' => $this->journalEntryDetail->sum('debit'),
        ];
    }
}
