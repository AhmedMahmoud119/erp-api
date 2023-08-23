<?php

use App\Domains\JournalEntry\Controllers\JournalEntryController;
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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'journal-entries'], function () {
    Route::get('/', [JournalEntryController::class, 'list']);
    Route::post('/import', [JournalEntryController::class, 'importJournalEntries']);
    Route::get('/export', [JournalEntryController::class, 'exportJournalEntries']);
    Route::get('/balance-sheet/list', [JournalEntryController::class, 'balanceSheet']);
    Route::get('/{id}', [JournalEntryController::class, 'findById']);
    Route::delete('/{id}', [JournalEntryController::class, 'delete']);
    Route::post('/create', [JournalEntryController::class, 'create']);
    Route::post('/update/{id}', [JournalEntryController::class, 'update']);
    Route::post('/{id}/import', [JournalEntryController::class, 'importJournalEntryDetailsFromFile']);
    Route::get('/{id}/export', [JournalEntryController::class, 'exportJournalEntryDetailsToFile']);

    Route::get('/balance-sheet/list', [JournalEntryController::class, 'balanceSheet']);
    Route::get('/profit-loss/list', [JournalEntryController::class, 'profitLoss']);
    Route::get('/trial-balance/list', [JournalEntryController::class, 'trialBalanceSheet']);
});
