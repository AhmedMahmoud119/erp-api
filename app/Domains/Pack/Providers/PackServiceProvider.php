<?php

declare(strict_types=1);

namespace App\Domains\Pack\Providers;

use App\Domains\Pack\Interfaces\PackRepositoryInterface;
use App\Domains\Pack\Repositories\PackMySqlRepository;
use Illuminate\Support\ServiceProvider;

class PackServiceProvider extends ServiceProvider
{
    public $bindings = [
        PackRepositoryInterface::class => PackMySqlRepository::class
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
