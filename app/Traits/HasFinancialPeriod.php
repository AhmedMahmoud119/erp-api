<?php
namespace App\Traits;

use App\Domains\FinancialPeriod\Models\FinancialPeriod;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasFinancialPeriod
{
    public function financialPeriod(): MorphToMany
    {
        return $this->morphToMany(FinancialPeriod::class, 'financiables');
    }
    public static function booted(){
        static::created(function ($model) {
            // logger($model->id);
            $model->financialPeriod()->attach(FinancialPeriod::current()->id);
        });
    }
}