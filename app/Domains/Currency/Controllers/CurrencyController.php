<?php

namespace App\Domains\Currency\Controllers;


use App\Domains\Currency\Models\Currency;
use App\Domains\Currency\Models\EnumPermissionCurrency;
use App\Domains\Currency\Request\StoreCurrencyRequest;
use App\Domains\Currency\Request\UpdateCurrencyRequest;
use App\Domains\Currency\Resources\CurrencyResource;
use App\Domains\Currency\Services\CurrencyService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct(private CurrencyService $currencyService)
    {
    }

    public function list()
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::view_currencies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  $this->currencyService->list();
    }

    public function delete($id)
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::delete_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->currencyService->delete($id);
        return response()->json([
            'message' => __('messages.deleted_successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::view_currencies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrencyResource($this->currencyService->findById($id));
    }

    public function create(StoreCurrencyRequest $request)
    {

//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::create_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->currencyService->create($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateCurrencyRequest $request)
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::edit_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->currencyService->update($id, $request);
        return response()->json([
            'message' => __('messages.updated_successfully'),
            'status' => true,
        ], 200);
    }
}
