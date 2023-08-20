<?php

declare(strict_types=1);

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
//   InitializeTenancyByDomain::class,
    InitializeTenancyBySubdomain::class,
    PreventAccessFromCentralDomains::class,
])
    ->prefix('v1')
    ->group(function () {


    $disk = Storage::build([
        'driver' => 'local',
        'root' => app_path('Domains'),
    ]);

    $directories = array_filter($disk->directories(), function ($directory) use ($disk) {
        return in_array("$directory/api.php", $disk->files($directory));
    });

    $domainRoutes = array_map(fn($directory) => app_path("Domains/$directory/api.php"), $directories);

    Route::middleware('api')
        ->prefix('api')
        ->group($domainRoutes);

});

// Route::get('/{any}',function(){
//     return view('welcome');
// })->where('any', '.*');;
