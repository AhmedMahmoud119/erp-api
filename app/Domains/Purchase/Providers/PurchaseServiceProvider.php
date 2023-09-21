<?php

declare(strict_types=1);

namespace App\Domains\Purchase\Providers;

use App\Domains\Purchase\Interfaces\PurchaseRepositoryInterface;
use App\Domains\Purchase\Repositories\PurchaseMySqlRepository;
use Illuminate\Support\ServiceProvider;

class PurchaseServiceProvider extends ServiceProvider
{
    public $bindings = [
        PurchaseRepositoryInterface::class => PurchaseMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
