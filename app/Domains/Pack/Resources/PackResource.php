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
            'price' => $this->price,
            'dimensions' => [
                'width' => $this->width,
                'length' => $this->length,
                'height' => $this->height,
                'weight' => $this->weight,
            ],
            'products' => $this->whenLoaded('products'),
            'creator' => $this->creator,

            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
