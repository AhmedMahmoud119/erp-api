<?php

namespace App\Domains\UnitType\Controllers;

use App\Domains\UnitType\Models\EnumPermissionUnitType;
use App\Domains\UnitType\Request\StoreUnitTypeRequest;
use App\Domains\UnitType\Request\UpdateUnitTypeRequest;
use App\Domains\UnitType\Resources\UnitTypeResource;
use App\Domains\UnitType\Models\UnitType;
use App\Domains\UnitType\Services\UnitTypeService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    public function __construct(private UnitTypeService $unitTypeService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUnitType::view_unit_type->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return UnitTypeResource::collection($this->unitTypeService->list());
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUnitType::view_unit_type->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnitTypeResource($this->unitTypeService->findById($id));
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUnitType::delete_unit_type->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->unitTypeService->delete($id);
        return response()->json([
            'message' => __('unit type deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StoreUnitTypeRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUnitType::create_unit_type->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->unitTypeService->create($request);
        return response()->json([
            'message' => __('unit type created successfully!'),
            'status' => true,
        ], Response::HTTP_OK);
    }

    public function update($id, UpdateUnitTypeRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionUnitType::edit_unit_type->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->unitTypeService->update($id, $request);
            return response()->json([
                'message' => __('Unit type information updated successfully!'),
                'status' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Faild To Update Record'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}