<?php

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'group'], function () {
    Route::get('/', [\App\Domains\Group\Controllers\GroupController::class, 'list']);
    Route::get('/{id}', [\App\Domains\Group\Controllers\GroupController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\Group\Controllers\GroupController::class, 'delete']);
    Route::post('/create', [\App\Domains\Group\Controllers\GroupController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\Group\Controllers\GroupController::class, 'update']);
    Route::get('export/pdf', [\App\Domains\Group\Controllers\GroupController::class, 'generatePDF']);
    Route::get('/export/csv', [\App\Domains\Group\Controllers\GroupController::class, 'export']);
    Route::post('/import/csv', [\App\Domains\Group\Controllers\GroupController::class, 'import']);

    Route::get('/export/example', [\App\Domains\Group\Controllers\GroupController::class, 'exportExample']);

});
