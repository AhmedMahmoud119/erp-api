<?php

namespace App\Domains\SafeMovement\Controllers;


use App\Domains\SafeMovement\Models\EnumPermissionSafeMovement;
use App\Domains\SafeMovement\Request\StoreSafeMovementRequest;
use App\Domains\SafeMovement\Request\UpdateSafeMovementRequest;
use App\Domains\SafeMovement\Resources\SafeMovementResource;
use App\Domains\SafeMovement\Services\SafeMovementService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class SafeMovementController extends Controller
{
    public function __construct(private SafeMovementService $safeMovementService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSafeMovement::view_SafeMovements->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return SafeMovementResource::collection($this->safeMovementService->list());
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSafeMovement::view_SafeMovements->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SafeMovementResource($this->safeMovementService->findById($id));
    }

    public function create(StoreSafeMovementRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSafeMovement::create_SafeMovement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->safeMovementService->create($request);
        return response()->json([
            'message' => __('Safe movement Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateSafeMovementRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSafeMovement::edit_SafeMovement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->safeMovementService->update($id, $request);
        return response()->json([
            'message' => __('Safe movement Updated Successfully'),
            'status' => true,
        ], 200);
    }
    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionSafeMovement::delete_SafeMovement->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->safeMovementService->delete($id);
        return response()->json([
            'message' => __('Safe movement Deleted Successfully'),
            'status' => true,
        ], Response::HTTP_OK);
    }

} //End Of Controller
