<?php

namespace App\Domains\Currency\Controllers;


use App\Domains\Currency\Models\Currency;
use App\Domains\Currency\Models\EnumCurrencies;
use App\Domains\Currency\Models\EnumPermissionCurrency;
use App\Domains\Currency\Request\FilterCurrencyRequest;
use App\Domains\Currency\Request\StoreCurrencyRequest;
use App\Domains\Currency\Request\UpdateCurrencyRequest;
use App\Domains\Currency\Resources\CurrencyResource;
use App\Domains\Currency\Services\CurrencyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{




    public function __construct(private CurrencyService $currencyService)
    {
    }

    public function list(FilterCurrencyRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::view_currencies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  CurrencyResource::collection($this->currencyService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::delete_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->currencyService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::view_currencies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrencyResource($this->currencyService->findById($id));
    }

    public function create(StoreCurrencyRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::create_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->currencyService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateCurrencyRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::edit_currency->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currency=$this->currencyService->update($id, $request);
        if($currency==true){
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);}
        return response()->json([
            'message' => __('can not update because must be at least one currency as a default'),
            'status' => false,
        ], 422);

    }
    public function getCodes()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCurrency::get_codes->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response()->json([
            'data' => DB::table('currency_codes')->get(),
        ], 200);

    }
}
