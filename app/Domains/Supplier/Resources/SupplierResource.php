<?php

namespace App\Domains\Supplier\Resources;

use App\Domains\Vendor\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code'=> $this->code,
            'name' => $this->name,
            'contact'=> $this->contact,
            'email'=> $this->email,
            'currency'          => $this->currency->name,
            'currency_id'       => $this->currency_id,
            'account_code'      => $this->account->code,
            'parent_account_id' => $this->parent_account_id,
//            'address'=> $this->address,
            'address'           => new AddressResource($this->address),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
