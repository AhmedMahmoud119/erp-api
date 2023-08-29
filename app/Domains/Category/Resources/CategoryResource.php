<?php

namespace App\Domains\Category\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'parent' => CategoryResource::make($this->whenLoaded('parent')),
            'creator_id' => $this->creator_id,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
