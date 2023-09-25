<?php
namespace App\Traits;

use App\Http\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Apply all relevant filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Http\Filters\BaseFilter  $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, BaseFilter $filter): Builder
    {
        return $filter->apply($query);
    }
}
