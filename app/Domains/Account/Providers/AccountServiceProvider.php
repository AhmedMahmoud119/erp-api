<?php

declare(strict_types=1);

namespace App\Domains\Account\Providers;

use App\Domains\Account\Interfaces\AccountRepositoryInterface;
use App\Domains\Account\Models\Account;
use App\Domains\Account\Observers\AccountObserver;
use App\Domains\Account\Repositories\AccountMySqlRepository;
use Illuminate\Support\ServiceProvider;

class AccountServiceProvider extends ServiceProvider
{
    public $bindings = [
        AccountRepositoryInterface::class => AccountMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        Account::observe(AccountObserver::class);
    }
}
