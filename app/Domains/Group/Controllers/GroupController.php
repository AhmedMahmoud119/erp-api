<?php

namespace App\Domains\Group\Controllers;


use App\Domains\Group\Models\Group;
use App\Domains\Group\Models\EnumPermissionGroup;
use App\Domains\Group\Request\FilterGroupRequest;
use App\Domains\Group\Request\ImportGroupRequest;
use App\Domains\Group\Request\StoreGroupRequest;
use App\Domains\Group\Request\UpdateGroupRequest;
use App\Domains\Group\Resources\GroupResource;
use App\Domains\Group\Services\GroupService;
use App\Domains\GroupType\Models\GroupType;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct(private GroupService $groupService)
    {
    }

    public function list(FilterGroupRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroup::view_groups->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  GroupResource::collection($this->groupService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroup::delete_group->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $delete = $this->groupService->delete($id);
        if ($delete == 1) {
            return response()->json([
                'message' => __('Deleted Successfully'),
                'status' => true,
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => __('Cant Delete this Group'),
                'status' => false,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroup::view_groups->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GroupResource($this->groupService->findById($id));
    }

    public function create(StoreGroupRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroup::create_group->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->groupService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateGroupRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionGroup::edit_group->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->groupService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
    public function generatePDF()
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissiongroup::generatePDF_groups->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->groupService->generatePDF();
    }
    public function export()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissiongroup::export_groups->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->groupService->export();
    }
    public function import(ImportGroupRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissiongroup::import_groups->value,'api'),Response::HTTP_FORBIDDEN, '403 Forbidden');

         $this->groupService->import($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function exportExample()
    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionAccount::import_accounts->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response()->json([
            'file_path' => url('group-example-import.xlsx'),
        ]);
    }

}
