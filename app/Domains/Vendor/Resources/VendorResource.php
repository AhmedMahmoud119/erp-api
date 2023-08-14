<?php

namespace App\Domains\Vendor\Resources;

use App\Domains\Module\Resources\ModuleResource;
use App\Domains\Tenant\Resources\TenantResource;
use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'code'          => $this->code,
            'name'        => $this->name,
            'contact'     => $this->contact,
            'email'       => $this->email,
            'currency'    => $this->currency->name,
            'creator'     => $this->creator->name,
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at'  => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
