<?php

namespace App\Domains\Tax\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'percentage'=>$this->percentage,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'updated_at'=>$this->updated_at->format('Y-m-d H:i'),
            // 'creator'=>$this->whenLoaded('creator')
        ];
    }
}
