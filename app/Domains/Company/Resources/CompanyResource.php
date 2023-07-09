<?php

namespace App\Domains\Company\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
