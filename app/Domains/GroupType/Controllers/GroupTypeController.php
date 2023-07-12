<?php

namespace App\Domains\GroupType\Controllers;


use App\Domains\GroupType\Models\GroupType;
use App\Domains\GroupType\Models\EnumPermissionGroupType;
use App\Domains\GroupType\Request\FilterGroupTypeRequest;
use App\Domains\GroupType\Request\StoreGroupTypeRequest;
use App\Domains\GroupType\Request\UpdateGroupTypeRequest;
use App\Domains\GroupType\Resources\GroupTypeResource;
use App\Domains\GroupType\Services\GroupTypeService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class GroupTypeController extends Controller
{
    public function __construct(private GroupTypeService $groupTypeService)
    {
    }

    public function list(FilterGroupTypeRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroupType::view_groupTypes->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  GroupTypeResource::collection($this->groupTypeService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroupType::delete_groupType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($this->groupTypeService->delete($id))
        {
            return response()->json([
                'message' => __('Deleted Successfully'),
                'status' => true,
            ], 200);
        }
        return response()->json([
            'message' => __('Can not Deleted because it belong to Group'),
            'status' => false,
        ], 402);

    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroupType::view_groupTypes->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GroupTypeResource($this->groupTypeService->findById($id));
    }

    public function create(StoreGroupTypeRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroupType::create_groupType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->groupTypeService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateGroupTypeRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroupType::edit_groupType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       if( $this->groupTypeService->update($id, $request))
       {
           return response()->json([
               'message' => __('Updated Successfully'),
               'status' => true,
           ], 200);
       }
        return response()->json([
            'message' => __('Can Not update this Group Type'),
            'status' => false,
        ], 402);

    }
 

}
