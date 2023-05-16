<?php

namespace App\Domains\User\Providers;

use App\Domains\User\Interfaces\UserRepositoryInterface;
use App\Domains\User\Repositories\UserMySqlRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepositoryInterface::class => UserMySqlRepository::class
    ];
}
