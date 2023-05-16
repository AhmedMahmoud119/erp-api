<?php

namespace App\Domains\Role\Resources;

use App\Domains\Permission\Resources\PermissionsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
        ];
    }
}
