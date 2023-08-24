<?php

namespace App\Domains\RevisionHistory\Controllers;

use App\Domains\RevisionHistory\Models\EnumPermissionRevisionHistory;
use App\Domains\RevisionHistory\Request\StoreRevisionHistoryRequest;
use App\Domains\RevisionHistory\Request\UpdateRevisionHistoryRequest;
use App\Domains\RevisionHistory\Resources\RevisionHistoryResource;
use App\Domains\RevisionHistory\Services\RevisionHistoryService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class RevisionHistoryController extends Controller
{
    public function __construct(private RevisionHistoryService $revisionHistoryService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::view_revisionHistories->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  RevisionHistoryResource::collection($this->revisionHistoryService->list());
    }

//    public function delete($id)
//    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::delete_revisionHistory->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $this->revisionHistoryService->delete($id);
//        return response()->json([
//            'message' => __('messages.deleted_successfully'),
//            'status' => true,
//        ], 200);
//    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::view_revisionHistories->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RevisionHistoryResource($this->revisionHistoryService->findById($id));
    }
    public function findByModel($model,$id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::view_revisionHistories->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return RevisionHistoryResource::collection($this->revisionHistoryService->findByModel($model,$id));
    }

    public function create(StoreRevisionHistoryRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::create_revisionHistory->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->revisionHistoryService->create($request);
        return response()->json([
            'message' => __('messages.created_successfully'),
            'status' => true,
        ], 200);
    }
  
//    public function update($id, UpdateRevisionHistoryRequest $request)
//    {
//        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionRevisionHistory::edit_revisionHistory->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        $this->revisionHistoryService->update($id, $request);
//        return response()->json([
//            'message' => __('messages.updated_successfully'),
//            'status' => true,
//        ], 200);
//    }
}
