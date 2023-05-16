<?php

namespace App\Domains\Currency\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'symbol'=>$this->symbol,
            'price_rate'=>$this->price_rate,
            'backup_changes'=>$this->backup_changes,
            'custom_price'=>$this->custom_price,
            'from'=>$this->from,
            'to'=>$this->to,
            'default'=>$this->default,
            'creator'=>$this->creator->name??null,


        ];
    }
}
