<?php

declare(strict_types=1);

namespace App\Domains\UnitType\Providers;

use App\Domains\UnitType\Interfaces\UnitTypeRepositoryInterface;
use App\Domains\UnitType\Repositories\UnitTypeMySqlRepository;
use Illuminate\Support\ServiceProvider;

class UnitTypeServiceProvider extends ServiceProvider
{
    public $bindings = [
        UnitTypeRepositoryInterface::class => UnitTypeMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
