<?php

namespace App\Domains\Supplier\Resources;

use App\Domains\Account\Resources\AccountResource;
use App\Domains\Currency\Resources\CurrencyResource;
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
            'currency' => CurrencyResource::make($this->whenloaded('currency'))?->name,
            'currency_id' => $this->currency_id,
            'account_code' => AccountResource::make($this->whenloaded('account'))?->code,
            'parent_account_id' => $this->parent_account_id,
            'balance' => $this->purchase_sum_total,
            'address' => AddressResource::make($this->whenloaded('address')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}