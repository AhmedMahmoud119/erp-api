<?php

namespace App\Domains\CashManagment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CashManagmentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'description' => $this->description,
            'amount' => $this->amount,
            'creator_id' => $this->creator_id,
            'creator' => $this->whenLoaded('creator')->name ?? null,
            'payment_method' => $this->payment_method,
            'account_id' => $this->whenLoaded('account')->name ?? null,
            'buyer_id' => $this->whenLoaded('buyer')->name ?? null,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
