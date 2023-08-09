<?php

namespace App\Domains\Tenant\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'plan' => $this->plan,
            'domain' => $this->domain,
            'industry_type' => $this->industry_type,
            'creator' => $this->creator?->name,
            'creator_id' => $this->creator_id,
            'assigned' => $this->assigned?->name,
            'assigned_id' => $this->assigned_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
