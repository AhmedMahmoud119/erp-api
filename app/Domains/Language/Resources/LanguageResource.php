<?php

namespace App\Domains\Language\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'key' => $this['key'],
            'value_ar' => $this['value_ar'],
            'value_en' => $this['value_en'],
        ];
    }
}
