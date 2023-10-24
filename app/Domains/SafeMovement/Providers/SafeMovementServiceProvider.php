<?php

declare(strict_types=1);

namespace App\Domains\SafeMovement\Providers;

use App\Domains\SafeMovement\Interfaces\SafeMovementRepositoryInterface;
use App\Domains\SafeMovement\Repositories\SafeMovementMySqlRepository;
use Illuminate\Support\ServiceProvider;

class SafeMovementServiceProvider extends ServiceProvider
{
    public $bindings = [
        SafeMovementRepositoryInterface::class => SafeMovementMySqlRepository::class
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
