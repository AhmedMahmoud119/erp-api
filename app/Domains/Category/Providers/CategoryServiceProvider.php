<?php

declare(strict_types=1);

namespace App\Domains\Category\Providers;

use App\Domains\Category\Interfaces\CategoryRepositoryInterface;
use App\Domains\Category\Repositories\CategoryMySqlRepository;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        CategoryRepositoryInterface::class => CategoryMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
