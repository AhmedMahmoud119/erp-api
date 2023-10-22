<?php

declare(strict_types=1);

namespace App\Domains\CashManagment\Providers;

use App\Domains\CashManagment\Interfaces\CashManagmentRepositoryInterface;
use App\Domains\CashManagment\Repositories\CashManagementMySqlRepository;
use Illuminate\Support\ServiceProvider;

class CashManagmentServiceProvider extends ServiceProvider
{
    public $bindings = [
        CashManagmentRepositoryInterface::class => CashManagementMySqlRepository::class
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