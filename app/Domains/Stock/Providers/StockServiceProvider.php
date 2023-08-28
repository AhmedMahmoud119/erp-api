<?php

declare(strict_types=1);

namespace App\Domains\Stock\Providers;

use App\Domains\Stock\Interfaces\StockRepositoryInterface;
use App\Domains\Stock\Repositories\StockMySqlRepository;
use Illuminate\Support\ServiceProvider;

class StockServiceProvider extends ServiceProvider
{
    public $bindings = [
        StockRepositoryInterface::class => StockMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
