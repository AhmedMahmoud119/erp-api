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
            'price'=>$this->price,
            'default'=>$this->default,
            'creator'=>$this->creator->name??null,
            'creation_date'=>$this->created_at->format('Y-m-d'),

        ];
    }
}
