<?php

namespace App\Domains\FinancialPeriod\Controllers;

use App\Domains\FinancialPeriod\Models\EnumPermissionFinancialPeriod;
use App\Domains\FinancialPeriod\Request\StoreFinancialPeriodRequest;
use App\Domains\FinancialPeriod\Request\UpdateFinancialPeriodRequest;
use App\Domains\FinancialPeriod\Resources\FinancialPeriodResource;
use App\Domains\FinancialPeriod\Services\FinancialPeriodService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class FinancialPeriodController extends Controller
{
    public function __construct(private FinancialPeriodService $financialPeriod)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionFinancialPeriod::view_financialPeriods->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  FinancialPeriodResource::collection($this->financialPeriod->list());
    }


    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionFinancialPeriod::view_financialPeriods->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  FinancialPeriodResource::make($this->financialPeriod->findById($id));
    }

    public function store(StoreFinancialPeriodRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionFinancialPeriod::create_financialPeriod->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->financialPeriod->create($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateFinancialPeriodRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionFinancialPeriod::edit_financialPeriod->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $financialPeriodUpdate = $this->financialPeriod->update($id, $request);
        if ($financialPeriodUpdate == false) {
            return response()->json([
                'message' => __('messages.cant_update_this_financial_period'),
                'status' => false,
            ], 400);
        }
        return response()->json([
            'message' => __('messages.updated_successfully'),
            'status' => true,
        ], 200);
    }
    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionFinancialPeriod::delete_financialPeriod->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->financialPeriod->delete($id);
        return response()->json([
            'message' => __('messages.deleted_successfully'),
            'status' => true,
        ], 200);
    }

}
