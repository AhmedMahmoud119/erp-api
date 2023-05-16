<?php

namespace App\Domains\Permission\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionModuleResource extends JsonResource
{

    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            "name" => __($this->name),
            "permission_categories" => PermissionCategoriesResource::collection($this->permissionCategories)
        ];
    }
}
