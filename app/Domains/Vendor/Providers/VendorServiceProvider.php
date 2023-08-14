<?php

declare(strict_types=1);

namespace App\Domains\Vendor\Providers;

use App\Domains\Vendor\Interfaces\VendorRepositoryInterface;
use App\Domains\Vendor\Repositories\VendorMySqlRepository;
use Illuminate\Support\ServiceProvider;

class VendorServiceProvider extends ServiceProvider
{
    public $bindings = [
        VendorRepositoryInterface::class => VendorMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
