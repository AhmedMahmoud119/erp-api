<?php

namespace App\Domains\Company\Resources;

use App\Domains\Tenant\Resources\TenantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'tenant' => TenantResource::make($this->whenLoaded('tenant')),
            'creator' => $this->creator->name,
        ];
    }
}
