<?php

declare(strict_types=1);

namespace App\Domains\Supplier\Providers;

use App\Domains\Supplier\Interfaces\SupplierRepositoryInterface;
use App\Domains\Supplier\Repositories\SupplierMySqlRepository;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
    public $bindings = [
        SupplierRepositoryInterface::class => SupplierMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
