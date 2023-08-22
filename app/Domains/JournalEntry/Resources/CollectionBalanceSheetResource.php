<?php

namespace App\Domains\JournalEntry\Resources;

use App\Domains\User\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionBalanceSheetResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'assets' => new BalanceSheetResource($this['assets']),
            'liabilities' => new BalanceSheetResource($this['liabilities']),
            'equity' => new BalanceSheetResource($this['equity']),
        ];
    }
}
