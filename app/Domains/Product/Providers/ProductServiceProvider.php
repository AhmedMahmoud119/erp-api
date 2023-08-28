<?php

declare(strict_types=1);

namespace App\Domains\Product\Providers;

use App\Domains\Product\Interfaces\ProductRepositoryInterface;
use App\Domains\Product\Repositories\ProductMySqlRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProductRepositoryInterface::class => ProductMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }
}
