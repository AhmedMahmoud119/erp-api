<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountsTrialBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'      => $this->id,
            'code'    => $this->code,
            'name'    => $this->name,
//            'balance' => $this->opening_balance
//                + $this->journalEntryDetail->sum('credit')
//                - $this->journalEntryDetail->sum('debit'),
//            'opening_balance' => $this->opening_balance,
            'total_credit' => $this->journalEntryDetail->sum('credit'),
            'total_debit' => $this->journalEntryDetail->sum('debit'),
        ];
    }
}
