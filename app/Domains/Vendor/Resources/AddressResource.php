<?php

namespace App\Domains\Vendor\Resources;

use App\Domains\Module\Resources\ModuleResource;
use App\Domains\Tenant\Resources\TenantResource;
use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'city'     => $this->city->name ?? '',
            'state'    => $this->state->name ?? '',
            'country'  => $this->country->name ?? '',
            'address'  => $this->address,
            'name'     => $this->name,
            'phone'    => $this->phone,
            'zip_code' => $this->zip_code,
        ];
    }
}
