<?php

namespace App\Domains\Customer\Resources;

use App\Domains\Vendor\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSalesReportResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name'              => $this->name,
            'purchase_sum_total'              => $this->purchase_sum_total,
        ];
    }
}
