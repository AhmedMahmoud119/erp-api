<?php

declare(strict_types=1);

namespace App\Domains\Company\Providers;

use App\Domains\Company\Interfaces\CompanyRepositoryInterface;
use App\Domains\Company\Repositories\CompanyMySqlRepository;
use App\Domains\Company\Repositories\ModuleMySqlRepository;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public $bindings = [
        CompanyRepositoryInterface::class => CompanyMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
