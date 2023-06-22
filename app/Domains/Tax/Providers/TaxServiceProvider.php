<?php

declare(strict_types=1);

namespace App\Domains\Tax\Providers;

use App\Domains\Tax\Interfaces\TaxRepositoryInterface;
use App\Domains\Tax\Models\Tax;
use App\Domains\Tax\Observers\TaxObserver;
use App\Domains\Tax\Repositories\TaxMySqlRepository;
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
        Tax::observe(TaxObserver::class);
    }
}
