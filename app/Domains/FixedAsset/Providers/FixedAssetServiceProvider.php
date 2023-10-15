<?php

declare(strict_types=1);

namespace App\Domains\FixedAsset\Providers;

use App\Domains\FixedAsset\Interfaces\FixedAssetRepositoryInterface;
use App\Domains\FixedAsset\Repositories\FixedAssetMySqlRepository;
use Illuminate\Support\ServiceProvider;

class FixedAssetServiceProvider extends ServiceProvider
{
    public $bindings = [
        FixedAssetRepositoryInterface::class => FixedAssetMySqlRepository::class
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
