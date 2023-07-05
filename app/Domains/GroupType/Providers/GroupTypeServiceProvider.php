<?php

declare(strict_types=1);

namespace App\Domains\GroupType\Providers;

use App\Domains\GroupType\Interfaces\GroupTypeRepositoryInterface;
use App\Domains\GroupType\Models\GroupType;
use App\Domains\GroupType\Observers\GroupTypeObserver;
use App\Domains\GroupType\Repositories\GroupTypeMySqlRepository;
use Illuminate\Support\ServiceProvider;

class GroupTypeServiceProvider extends ServiceProvider
{
    public $bindings = [
        GroupTypeRepositoryInterface::class => GroupTypeMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {
        GroupType::observe(GroupTypeObserver::class);
    }
}
