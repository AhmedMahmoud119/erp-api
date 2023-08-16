<?php

declare(strict_types=1);

namespace App\Domains\Customer\Providers;

use App\Domains\Customer\Interfaces\CustomerRepositoryInterface;
use App\Domains\Customer\Repositories\CustomerMySqlRepository;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    public $bindings = [
        CustomerRepositoryInterface::class => CustomerMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
