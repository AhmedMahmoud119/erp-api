<?php

declare(strict_types=1);

namespace App\Domains\Form\Providers;

use App\Domains\Form\Interfaces\FormRepositoryInterface;
use App\Domains\Form\Repositories\FormMySqlRepository;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public $bindings = [
        FormRepositoryInterface::class => FormMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
