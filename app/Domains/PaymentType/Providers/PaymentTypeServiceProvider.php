<?php

namespace App\Domains\PaymentType\Providers;

use App\Domains\PaymentType\Interfaces\PaymentTypeRepositoryInterface;
use App\Domains\PaymentType\Repositories\PaymentTypeMySqlRepository;
use Illuminate\Support\ServiceProvider;

class PaymentTypeServiceProvider extends ServiceProvider
{
    public $bindings = [
        PaymentTypeRepositoryInterface::class => PaymentTypeMySqlRepository::class,
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
