<?php

namespace App\Domains\Warehouse\Providers;

use App\Domains\Warehouse\Interfaces\WarehouseRepositoryInterface;
use App\Domains\Warehouse\Repositories\WarehouseMySqlRepository;
use Illuminate\Support\ServiceProvider;

class WarehouseServiceProvider extends ServiceProvider
{
    public $bindings = [
        WarehouseRepositoryInterface::class => WarehouseMySqlRepository::class,
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
