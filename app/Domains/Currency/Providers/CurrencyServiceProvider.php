<?php

declare(strict_types=1);

namespace App\Domains\Currency\Providers;

use App\Domains\Currency\Interfaces\CurrencyRepositoryInterface;
use App\Domains\Currency\Models\Currency;
use App\Domains\Currency\Observers\CurrencyObserver;
use App\Domains\Currency\Repositories\CurrencyMySqlRepository;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public $bindings = [
       CurrencyRepositoryInterface::class => CurrencyMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        Currency::observe(CurrencyObserver::class);
    }
}
