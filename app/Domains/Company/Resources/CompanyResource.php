<?php

namespace App\Domains\Company\Resources;

use App\Domains\Module\Resources\ModuleResource;
use App\Domains\Tenant\Resources\TenantResource;
use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'creator' => $this->creator->name,
            'user' => UserResource::make($this->whenLoaded('user'))->only(['id', 'name']),
            'modules' => ModuleResource::collection($this->whenLoaded('modules')),
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
