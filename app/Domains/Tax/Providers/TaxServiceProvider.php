<?php

declare(strict_types=1);

namespace App\Domains\Tax\Providers;

use App\Domains\Tax\Interfaces\TaxRepositoryInterface;
use App\Domains\Tax\Repositories\TaxMySqlRepository;
use App\Domains\Tax\Repositories\ModuleMySqlRepository;
use Illuminate\Support\ServiceProvider;

class TaxServiceProvider extends ServiceProvider
{
    public $bindings = [
        TaxRepositoryInterface::class => TaxMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
