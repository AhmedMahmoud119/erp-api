<?php

namespace App\Domains\GroupType\Resources;

use App\Domains\Group\Resources\GroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChartOfAccountsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->name,
            'icon' => $this->icon,
            'children' => ChartOfAccountsResource::collection($this->whenLoaded('children')),
        ];
    }
}
