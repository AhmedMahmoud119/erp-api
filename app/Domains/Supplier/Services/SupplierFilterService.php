<?php

namespace App\Domains\Supplier\Services;

use App\Http\Filters\BaseFilter;
use App\Traits\FilterRepository;
use Illuminate\Database\Eloquent\Builder;

class SupplierFilterService extends BaseFilter
{
    use FilterRepository;
    public function search(string $value = null): Builder
    {
        $result = $this->builder->where('name', 'like', "%{$value}%")
            ->Orwhere('code', 'like', "%{$value}%");
        return $result;
    }
    public function transaction_from(string $value = null): Builder
    {
        return $this->builder->whereHas('purchase', function ($query) {
            $query->whereDate('date', '>=', request()->transaction_from);
        });
    }
    public function transaction_to(string $value = null): Builder
    {
        return $this->builder->whereHas('purchase', function ($query) {
            $query->whereDate('date', '<=', request()->transaction_to);
        });
    }
}