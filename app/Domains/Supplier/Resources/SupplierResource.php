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
            'code' => $this->code,
            'name' => $this->name,
            'contact' => $this->contact,
            'email' => $this->email,
            'currency' => $this->currency->name ?? null,
            'currency_id' => $this->currency_id,
            'account_code' => $this->account->code ?? null,
            'parent_account_id' => $this->parent_account_id,
            'balance' => $this->purchase_sum_total ?? 0,
            'creator' => $this->whenloaded('creator')->name ?? '',
            'address' => new AddressResource($this->address),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
