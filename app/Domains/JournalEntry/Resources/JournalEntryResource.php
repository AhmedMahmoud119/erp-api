<?php

namespace App\Domains\JournalEntry\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JournalEntryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'status'=>$this->status,
//            'tenant_id'=>$this->tenant->id,
//            'tenant_name'=>$this->tenant->name,
            'creator'=>$this->creator->name,

        ];
    }
}
