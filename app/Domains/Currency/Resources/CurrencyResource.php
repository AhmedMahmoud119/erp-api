<?php

namespace App\Domains\Currency\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'symbol' => $this->symbol,
            'price_rate' => $this->price_rate,
            'backup_changes' => $this->backup_changes,
            'from' => $this->from,
            'to' => $this->to,
            'price' => $this->price,
            'default' => $this->default,
            'creator' => $this->creator->name ?? null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
