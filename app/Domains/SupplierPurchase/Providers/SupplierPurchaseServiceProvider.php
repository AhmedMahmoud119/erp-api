<?php

declare(strict_types=1);

namespace App\Domains\SupplierPurchase\Providers;

use App\Domains\SupplierPurchase\Interfaces\SupplierPurchaseRepositoryInterface;
use App\Domains\SupplierPurchase\Repositories\SupplierPurchaseMySqlRepository;
use Illuminate\Support\ServiceProvider;

class SupplierPurchaseServiceProvider extends ServiceProvider
{
    public $bindings = [
        SupplierPurchaseRepositoryInterface::class => SupplierPurchaseMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
