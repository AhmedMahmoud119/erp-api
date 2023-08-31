<?php

namespace App\Domains\Stock\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'opening_stock' => $this->opening_stock,
            'purchasing_price' => $this->purchasing_price,
            'selling_price' => $this->selling_price,
            'creator' => $this->whenLoaded('creator'),
            'product' => $this->whenLoaded('product'),
            'warehouse' => $this->whenLoaded('warehouse'),
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}