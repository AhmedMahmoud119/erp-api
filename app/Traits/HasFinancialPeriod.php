<?php

namespace App\Traits;

use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Validation\ValidationException;

trait HasFinancialPeriod
{
    public function financialPeriod(): MorphToMany
    {
        return $this->morphToMany(FinancialPeriod::class, 'financiables');
    }
    public static function booted()
    {
        static::creating(function ($model) {
            if (!FinancialPeriod::current()) {

                throw ValidationException::withMessages(['financial_period' => 'You can not creating on closed Financial Period']);
            }
        });
        static::created(function ($model) {
            $model->financialPeriod()->attach(FinancialPeriod::current()->id);
        });
    }
}
