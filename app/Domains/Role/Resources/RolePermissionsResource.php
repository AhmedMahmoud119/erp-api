<?php

namespace App\Domains\Role\Resources;

use App\Domains\Permission\Resources\PermissionsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at?->format('Y-m-d'),
            'updated_at' => $this->updated_at?->format('Y-m-d'),
            'permissions' => PermissionsResource::collection($this->permissions),
            'users' => count($this->users),

        ];
    }
}
