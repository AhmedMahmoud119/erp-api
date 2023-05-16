<?php
namespace App\Domains\Permission\Providers;

use App\Domains\Permission\Interfaces\PermissionRepositoryInterface;
use App\Domains\Permission\Repositories\PermissionMySqlRepository;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public $bindings = [
        PermissionRepositoryInterface::class => PermissionMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
