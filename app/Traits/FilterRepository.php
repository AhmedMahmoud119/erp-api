<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

trait FilterRepository
{
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
