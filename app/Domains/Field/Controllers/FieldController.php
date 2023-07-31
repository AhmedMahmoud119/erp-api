<?php

namespace App\Domains\Field\Controllers;

use App\Domains\Field\Models\EnumPermissionField;
use App\Domains\Field\Request\StoreFieldRequest;
use App\Domains\Field\Request\UpdateFieldRequest;
use App\Domains\Field\Resources\FieldTypeResource;
use App\Domains\Field\Services\FieldService;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class FieldController extends Controller
{
    public function __construct(private FieldService $fieldService)
    {
    }


    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::view_fields->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return FieldTypeResource::collection($this->fieldService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::delete_field->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->fieldService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::view_fields->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->fieldService->findById($id);
    }

    public function create(StoreFieldRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::create_field->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field = $this->fieldService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
            'field' => $field,
        ], 200);
    }

    public function update($id, UpdateFieldRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::edit_field->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($this->fieldService->update($id, $request)) {
            return response()->json([
                'message' => __('Updated Successfully'),
                'status' => true,
            ], 200);
        } else {
            return response()->json([
                'message' => __('cant update its belongs to form')
            ]);
        }
    }

    public function listFieldTypes()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionField::view_fields->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new FieldTypeResource($this->fieldService->listFieldTypes());
    }

}
