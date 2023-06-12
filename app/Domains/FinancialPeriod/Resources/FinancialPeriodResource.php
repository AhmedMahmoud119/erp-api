<?php

namespace App\Domains\FinancialPeriod\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialPeriodResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'financial_Year'=>$this->financial_Year,
            'status'=>$this->status,
            'financial_Year_Start'=>$this->financial_Year_Start,
            'financial_Year_End'=>$this->financial_Year_End,
            'created_at'=>$this->created_at->format('Y-m-d H:i'),
            'updated_at'=>$this->updated_at->format('Y-m-d H:i'),
            'creator'=>UserResource::make($this->whenLoaded('creator'))
        ];
    }
}
