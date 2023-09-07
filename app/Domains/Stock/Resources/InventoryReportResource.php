<?php

namespace App\Domains\Stock\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryReportResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'number_of_product' => $this->quantity,
            'total_purchasing_price' => ($this->purchasing_price * $this->quantity),
            'total_selling_price' => ($this->selling_price * $this->quantity),
            'warehouse_name' => $this->whenLoaded('warehouse')?->name,
        ];
    }
}
