<?php
namespace App\Domains\Field\Providers;


use App\Domains\Field\Interfaces\FieldRepositoryInterface;
use App\Domains\Field\Repositories\FieldMySqlRepository;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    public $bindings = [
        FieldRepositoryInterface::class => FieldMySqlRepository::class
    ];

    public function register()
    {
        //
    }

    public function boot()
    {

    }
}
