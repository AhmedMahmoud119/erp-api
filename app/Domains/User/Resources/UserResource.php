<?php

namespace App\Domains\User\Resources;

use App\Domains\Role\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'parent' => $this->parent->name ?? '',
            'parent_id' => $this->parent_id,
            'role' =>  $this->roles->first()->name ?? '',
            'role_id' =>  $this->roles->first()->id ?? '',

        ];
    }
}
