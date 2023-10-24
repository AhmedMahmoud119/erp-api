<?php

namespace App\Domains\SafeMovement\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SafeMovementResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'description' => $this->description,
            'amount' => $this->amount,
            'destination_safe_id' => $this->destination_id,
            'destination_safe' => $this->whenLoaded('destination')->name ?? null,
            'source_safe_id' => $this->source_id,
            'source_safe' => $this->whenLoaded('source')->name ?? null,
            'assets_involved' => $this->assets_involved,
            'creator_id' => $this->creator_id,
            'creator' => $this->whenLoaded('creator')->name ?? null,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
