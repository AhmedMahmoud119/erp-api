<?php

namespace App\Domains\CashManagment\Controllers;


use App\Domains\CashManagment\Models\EnumPermissionCashManagment;
use App\Domains\CashManagment\Request\StoreCashManagmentRequest;
use App\Domains\CashManagment\Request\UpdateCashManagmentRequest;
use App\Domains\CashManagment\Resources\CashManagmentResource;
use App\Domains\CashManagment\Services\CashManagmentService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class CashManagmentController extends Controller
{
    public function __construct(private CashManagmentService $cashManagmentService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::view_CashManagments->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return CashManagmentResource::collection($this->cashManagmentService->list());
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::view_CashManagments->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashManagmentResource($this->cashManagmentService->findById($id));
    }

    public function create(StoreCashManagmentRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::create_CashManagment->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->cashManagmentService->create($request);
        return response()->json([
            'message' => __('Asset Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateCashManagmentRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::edit_CashManagment->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->cashManagmentService->update($id, $request);
        return response()->json([
            'message' => __('Asset Updated Successfully'),
            'status' => true,
        ], 200);
    }
    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCashManagment::delete_CashManagment->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->cashManagmentService->delete($id);
        return response()->json([
            'message' => __('Asset Deleted Successfully'),
            'status' => true,
        ], Response::HTTP_OK);
    }

} //End Of Controller
