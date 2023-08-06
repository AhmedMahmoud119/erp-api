<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class JournalEntryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'entry_no' => $this->entry_no,
            'date' => $this->date,
            'description' => $this->description,
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'details' => JournalEntryDetailsResource::collection($this->whenLoaded('details')),
        ];
    }
}
