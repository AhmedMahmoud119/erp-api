<?php

namespace App\Domains\CashManagment\Controllers;


use App\Domains\CashManagment\Models\EnumPermissionCashManagment;
use App\Domains\CashManagment\Request\StoreCashManagmentRequest;
use App\Domains\CashManagment\Request\UpdateCashManagmentRequest;
use App\Domains\CashManagment\Resources\CashManagementResource;
use App\Domains\CashManagment\Services\CashManagementService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CashManagementController extends Controller
{
    public function __construct(private CashManagementService $cashManagementService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::view_CashManagements->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return CashManagementResource::collection($this->cashManagementService->list());
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::view_CashManagements->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashManagementResource($this->cashManagementService->findById($id));
    }

    public function create(StoreCashManagmentRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::create_CashManagement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($this->cashManagementService->create($request))
            return response()->json([
                'message' => __('payment Created Successfully'),
                'status' => true,
            ], 200);

        return response()->json([
            'message' => __('Can not processing your request, please try again.'),
            'status' => false,
        ], 500);
    }
    public function update($id, UpdateCashManagmentRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::edit_CashManagement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($this->cashManagementService->update($id, $request))
            return response()->json([
                'message' => __('payment Updated Successfully'),
                'status' => true,
            ], 200);

        return response()->json([
            'message' => __('Can not processing your request, please try again.'),
            'status' => false,
        ], 500);
    }
    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::delete_CashManagement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($this->cashManagementService->delete($id))
            return response()->json([
                'message' => __('payment Deleted Successfully'),
                'status' => true,
            ], Response::HTTP_OK);

        return response()->json([
            'message' => __('The item does not exists.'),
            'status' => false,
        ], 500);
    }

} //End Of Controller
