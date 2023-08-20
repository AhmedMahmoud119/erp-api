<?php

namespace App\Domains\FinancialPeriod\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialPeriodResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'start' => $this->start,
            'end' => $this->end,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i'),
            'creator' => UserResource::make($this->whenLoaded('creator'))->only(['id', 'name']),
        ];
    }
}
