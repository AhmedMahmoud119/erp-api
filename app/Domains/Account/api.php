<?php

use App\Domains\Account\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'account'], function () {
    Route::get('/', [\App\Domains\Account\Controllers\AccountController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'delete']);
    Route::post('bulk-delete', [\App\Domains\Account\Controllers\AccountController::class, 'bulkDelete']);
    Route::post('/create', [\App\Domains\Account\Controllers\AccountController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Account\Controllers\AccountController::class, 'update']);
    Route::post('/import', [\App\Domains\Account\Controllers\AccountController::class, 'import']);

    Route::get('/export/example', [\App\Domains\Account\Controllers\AccountController::class, 'exportExample']);

});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('parents/accounts', [\App\Domains\Account\Controllers\AccountController::class, 'parents']);
    Route::get('not-parents/accounts', [\App\Domains\Account\Controllers\AccountController::class, 'notParents']);
});
