<?php

namespace App\Domains\Product\Resources;

use App\Domains\Category\Resources\CategoryResource;
use App\Domains\Tax\Resources\TaxResource;
use App\Domains\UnitType\Models\UnitType;
use App\Domains\UnitType\Resources\UnitTypeResource;
use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'opening_stock' => $this->opening_stock,
            'selling_price' => $this->selling_price,
            'purchase_price' => $this->purchase_price,
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tax' => TaxResource::make($this->whenLoaded('taxes')),
            'unit' => UnitTypeResource::make($this->whenLoaded('unit')),
            'specs' => SpecResource::collection($this->whenLoaded('specs')),
            'tax_id'=> $this->tax_id,
            'unit_id'=> $this->unit_id,
            'category_id'=> $this->category_id,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
