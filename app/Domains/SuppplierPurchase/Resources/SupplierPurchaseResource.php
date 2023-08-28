<?php

namespace App\Domains\SupplierPurchase\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierPurchaseResource extends JsonResource
{

    public function toArray($request)
    {


        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'total' => $this->total,
            'discount' => $this->discount,
            'date' => $this->date,
            'invoice_number' => $this->invoice_number,
            'creator' => $this->creator,
            'products' => $this->products,
            'stock' => $this->stock,
            'supplier' => $this->supplier,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}