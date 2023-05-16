<?php

declare(strict_types=1);

namespace App\Domains\Language\Providers;

use App\Domains\Language\Interfaces\LanguageRepositoryInterface;
use App\Domains\Language\Repositories\LanguageMySqlRepository;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    public $bindings = [
        LanguageRepositoryInterface::class => LanguageMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
