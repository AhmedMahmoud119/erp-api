<?php

namespace App\Domains\SupplierPurchase\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierPurchaseResource extends JsonResource
{

    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'total' => $this->total,
            'date' => $this->date,
            'creator' => $this->creator,
            'products' => $this->products,
            'stock' => $this->stock,
            'supplier' => $this->supplier,
            'taxes' => $this->taxes,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}