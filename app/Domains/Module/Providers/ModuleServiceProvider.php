<?php

declare(strict_types=1);

namespace App\Domains\Module\Providers;

use App\Domains\Module\Interfaces\ModuleRepositoryInterface;
use App\Domains\Module\Repositories\ModuleMySqlRepository;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public $bindings = [
        ModuleRepositoryInterface::class => ModuleMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
