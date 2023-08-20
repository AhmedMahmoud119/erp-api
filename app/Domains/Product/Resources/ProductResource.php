<?php

namespace App\Domains\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'description'=>$this->description,
            'quantity'=>$this->quantity,
            'opening_stock'=>$this->opening_stock,
            'selling_prirce'=>$this->selling_prirce,
            'purchase_prirce'=>$this->purchase_prirce,
            'creator'=>$this-> creator,
            'category'=>$this->category,
            'taxes'=>$this->taxes,
            'unit'=>$this->unit,
            'specs'=>$this->specs,
            'created_at'=>$this->created_at->format('Y-m-d'),
            'updated_at'=>$this->updated_at->format('Y-m-d'),
        ];
    }
}
