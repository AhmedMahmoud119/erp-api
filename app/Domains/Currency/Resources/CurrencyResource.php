<?php

namespace App\Domains\Currency\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'code'=>$this->code,
            'symbol'=>$this->symbol,
            'price_rate'=>$this->price_rate,
            'custom_price'=>$this->custom_price,
            'default'=>$this->default,
            'creator'=>$this->creator->name??null,
            'creator_date'=>$this->created_at->format('Y-m-d'),

        ];
    }
}
