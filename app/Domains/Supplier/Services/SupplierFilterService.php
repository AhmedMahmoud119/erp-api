<?php

namespace App\Domains\Supplier\Services;

use App\Http\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class SupplierFilterService extends BaseFilter
{
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
    public function from(string $value = null): Builder
    {
        return $this->builder->whereDate('created_at', '>=', $value);
    }
    public function to(string $value = null): Builder
    {
        return $this->builder->whereDate('created_at', '<=', $value);
    }
    public function creator(string $value = null): Builder
    {
        return $this->builder->where('creator_id', $value);
    }

    public function sort(array $value = [])
    {
        if (isset($value['by']) && !Schema::hasColumn('suppliers', $value['by'])) {
            return $this->builder;
        }

        return $this->builder->orderBy(
            $value['by'] ?? 'created_at',
            $value['order'] ?? 'desc'
        );
    }
}
