<?php

namespace App\Domains\Pack\Controllers;

use App\Domains\Pack\Models\EnumPermissionPack;
use App\Domains\Pack\Request\UpdatePackRequest;
use App\Domains\Pack\Request\StorePackRequest;
use App\Domains\Pack\Resources\PackResource;
use App\Domains\Pack\Services\PackService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class PackController extends Controller
{
    public function __construct(private PackService $packService)
    {
    }
    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPack::view_packs->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return PackResource::collection($this->packService->list());
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPack::view_packs->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PackResource($this->packService->findById($id));
    }
    public function create(StorePackRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPack::create_pack->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->packService->create($request);
        return response()->json([
            'message' => __('Pack Created Successfully!'),
            'status' => true,
        ], 200);
    }
    public function update($id, UpdatePackRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPack::edit_pack->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->packService->update($id, $request);
        return response()->json([
            'message' => __('Pack Updated Successfully!'),
            'status' => true,
        ], 200);
    }
    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPack::delete_pack->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->packService->delete($id);
        return response()->json([
            'message' => __('Pack moved to trash!'),
            'status' => true,
        ], 200);
    }

}