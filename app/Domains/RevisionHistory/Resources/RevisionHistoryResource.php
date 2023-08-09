<?php

namespace App\Domains\RevisionHistory\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RevisionHistoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'edited_by' => $this->editedBy?->name,
            'old_data' => $this->old_data,
            'new_data' => $this->new_data,
            'reason' => $this->reason,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
