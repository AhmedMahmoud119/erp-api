<?php

namespace App\Domains\Supplier\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email'=> $this->email,
            'code'=> $this->code,
            'contact'=> $this->contact,
            'parent'=> $this->parent,
            'currency_id'=> $this->currency_id,
            'address_id'=> $this->address_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
