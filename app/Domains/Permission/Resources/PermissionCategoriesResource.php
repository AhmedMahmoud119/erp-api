<?php

namespace App\Domains\Permission\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionCategoriesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => __($this->name),
            'permissions' => PermissionsResource::collection($this->permissions),
            'checked' => false
        ];
    }
}
