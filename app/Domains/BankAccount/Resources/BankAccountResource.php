<?php

namespace App\Domains\BankAccount\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'account_number'=>$this->account_number,
            'holder_name'=>$this->holder_name,
            'account_type'=>$this->account_type,
            'chart_of_account'=>$this->chart_of_account,
            'currency'=>$this->currency->name??null,
            'currency_id'=>$this->currency->id??null,
            'creator'=>$this->creator->name??null,
            'opening_balance'=>$this->opening_balance,
            'current_balance'=>$this->current_balance,
            'status'=>$this->status,
            'authorized_by' => $this->authorized_by??null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
}
