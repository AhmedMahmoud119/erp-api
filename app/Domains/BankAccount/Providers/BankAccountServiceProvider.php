<?php

declare(strict_types=1);

namespace App\Domains\BankAccount\Providers;

use App\Domains\BankAccount\Interfaces\BankAccountRepositoryInterface;
use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\BankAccount\Observers\BankAccountObserver;
use App\Domains\BankAccount\Repositories\BankAccountMySqlRepository;
use Illuminate\Support\ServiceProvider;

class BankAccountServiceProvider extends ServiceProvider
{
    public $bindings = [
        BankAccountRepositoryInterface::class => BankAccountMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        BankAccount::observe(BankAccountObserver::class);
    }
}
