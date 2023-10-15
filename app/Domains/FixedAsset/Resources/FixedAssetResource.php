<?php

namespace App\Domains\FixedAsset\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FixedAssetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                         => $this->id,
            'code'                       => $this->code,
            'name'                       => $this->name,
            'description'                => $this->description,
            'acquisition_date'           => $this->acquisition_date,
            'acquisition_value'          => $this->acquisition_value,
            'depreciation_ratio'         => $this->depreciation_ratio,
            'depreciation_duration_value'=> $this->depreciation_duration_value,
            'depreciation_duration_type' => $this->depreciation_duration_type,
            'depreciation_value'         => $this->depreciation_value,
            'depreciation'               => $this->depreciation ,
            'parent'                     => $this->whenLoaded('parent'),
            'creator_id'                 => $this->creator_id,
            'creator'                    => $this->whenLoaded('creator')->name ?? null,
            'created_at'                 => $this->created_at->format('Y-m-d'),
            'updated_at'                 => $this->updated_at->format('Y-m-d'),
        ];
    }
}
