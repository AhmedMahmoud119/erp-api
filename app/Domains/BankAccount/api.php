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

Route::group(['middleware' => 'auth:sanctum','prefix' => 'bankAccount'],function (){
    Route::get('/', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'list']);
    Route::get('/{id}', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'findById']);
    Route::delete('/{id}', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'delete']);
    Route::post('/create', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'create']);
    Route::post('/update/{id}', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'update']);
    Route::get('export/pdf', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'generatePDF']);
    Route::get('/export/cvs', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'export']);
    Route::get('/example/download', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'exampleDownload']);
    Route::post('/import/csv', [\App\Domains\BankAccount\Controllers\BankAccountController::class, 'import']);

});

