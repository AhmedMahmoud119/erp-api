<?php

declare(strict_types=1);

namespace App\Domains\FinancialPeriod\Providers;

use App\Domains\FinancialPeriod\Interfaces\FinancialPeriodRepositoryInterface;
use App\Domains\FinancialPeriod\Repositories\FinancialPeriodMySqlRepository;
use App\Domains\FinancialPeriod\Repositories\ModuleMySqlRepository;
use Illuminate\Support\ServiceProvider;

class FinancialPeriodServiceProvider extends ServiceProvider
{
    public $bindings = [
        FinancialPeriodRepositoryInterface::class => FinancialPeriodMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
