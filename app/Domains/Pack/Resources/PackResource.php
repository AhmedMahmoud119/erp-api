<?php

namespace App\Domains\Pack\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'material' => $this->material,
            'weight' => $this->weight,

            'dimensions' => [
                'width' => $this->width,
                'length' => $this->length,
                'height' => $this->height,
            ],

            'selling_prirce' => $this->selling_prirce,
            'purchase_prirce' => $this->purchase_prirce,
            'retail_prirce' => $this->retail_prirce,

            'products' => $this->products,
            'creator' => $this->creator,

            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}