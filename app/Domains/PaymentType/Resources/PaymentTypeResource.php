<?php

namespace App\Domains\PaymentType\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
