<?php

declare(strict_types=1);

namespace App\Domains\RevisionHistory\Providers;

use App\Domains\RevisionHistory\Interfaces\RevisionHistoryRepositoryInterface;
use App\Domains\RevisionHistory\Repositories\RevisionHistoryMySqlRepository;
use Illuminate\Support\ServiceProvider;

class RevisionHistoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        RevisionHistoryRepositoryInterface::class => RevisionHistoryMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
