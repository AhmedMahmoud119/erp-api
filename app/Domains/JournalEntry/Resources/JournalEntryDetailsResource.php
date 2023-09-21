<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\Account\Resources\AccountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalEntryDetailsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'account_id' => $this->account_id,
            'account' => AccountResource::make($this->whenLoaded('account')),
            'debit' => $this->debit,
            'credit' => $this->credit,
            'journal_entry_id' => $this->journal_entry_id,
            'description' => $this->description,
        ];
    }
}
