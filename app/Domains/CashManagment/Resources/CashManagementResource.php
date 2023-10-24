<?php

namespace App\Domains\CashManagment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashManagementResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'description' => $this->description,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,

            'cashable_id' => $this->cashable_id,
            'cashable_name' => $this->whenLoaded('cashable')->name ?? null,
            'account_id' => $this->account_id,
            'account_name' => $this->whenLoaded('account')->name ?? null,
            'creator_id' => $this->creator_id,
            'creator' => $this->whenLoaded('creator')->name ?? null,

            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
