<?php

namespace App\Domains\Customer\Resources;

use App\Domains\Vendor\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'account_id' => $this->account_id,
            'account_name' => $this->account->name,

            'parent_account_id' => $this->parent_account_id,
            'parent_account_name' => $this->parent->name,


            'creator' => $this->creator->name,
            'balance' => $this->purchase_sum_total ?? 0,
            'address' => new AddressResource($this->address),
            'billing_address' => new AddressResource($this->billingAddress),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
