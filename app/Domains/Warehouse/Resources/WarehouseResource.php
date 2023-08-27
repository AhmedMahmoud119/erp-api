<?php

namespace App\Domains\Warehouse\Resources;

use App\Domains\Vendor\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'creator'     => $this->creator->name,
            'assigned'    => $this->assigned->name,
            'assigned_id' => $this->assigned_id,
            'address'     => new AddressResource($this->address),
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
