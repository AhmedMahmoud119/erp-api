<?php
namespace App\Domains\Role\Providers;

use App\Domains\Role\Interfaces\RoleRepositoryInterface;
use App\Domains\Role\Repositories\RoleMySqlRepository;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    public $bindings = [
        RoleRepositoryInterface::class => RoleMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
