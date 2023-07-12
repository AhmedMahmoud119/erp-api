<?php

declare(strict_types=1);

namespace App\Domains\Group\Providers;

use App\Domains\Group\Interfaces\GroupRepositoryInterface;
use App\Domains\Group\Models\Group;
use App\Domains\Group\Observers\GroupObserver;
use App\Domains\Group\Repositories\GroupMySqlRepository;
use Illuminate\Support\ServiceProvider;

class GroupServiceProvider extends ServiceProvider
{
    public $bindings = [
        GroupRepositoryInterface::class => GroupMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        Group::observe(GroupObserver::class);
    }
}
