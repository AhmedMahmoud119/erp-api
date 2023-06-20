<?php

namespace App\Domains\Form\Controllers;

use App\Domains\Form\Models\EnumPermissionForm;
use App\Domains\Form\Request\AddFieldFormResponseRequest;
use App\Domains\Form\Request\HideFieldFormRequest;
use App\Domains\Form\Request\StoreFormRequest;
use App\Domains\Form\Request\UpdateFormRequest;
use App\Domains\Form\Request\AddFieldFormRequest;
use App\Domains\Form\Services\FormService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    public function __construct(private FormService $formService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::view_forms->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->list();
    }

    public function viewFields($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::viewFields_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->viewFields($id);
    }

    public function viewVersionFields($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::viewFields_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->viewVersionFields($id);
    }

    public function deleteFormField($form_field_id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::deleteFormField_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $deleteFormField = $this->formService->deleteFormField($form_field_id);
        if ($deleteFormField) {
            return response()->json([
                'success' => __('Deleted Successfully')
            ]);
        }
        return response()->json([
            'error' => __('cant delete field with response')
        ], 401);
    }

    public function hideFormField($form_field_id, HideFieldFormRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::hideFormField_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->formService->hideFormField($form_field_id, $request);
        return response()->json([
            'success' => __('Updated Successfully')
        ]);
    }

    public function export($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::export_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->export($id);
    }

    public function viewResponses($id, Request $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::viewResponses_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->viewResponses($id, $request);
    }

    public function viewVersionResponses($id, Request $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::viewResponses_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->viewVersionResponses($id, $request);
    }

    public function listFormVersions($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::listFormVersions_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->listFormVersions($id);
    }

    public function addField($id, AddFieldFormRequest $request)
    {

        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::addField_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->formService->addField($id, $request);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
        return response()->json([
            'message' => __('Created Successfully')
        ]);
    }

    public function versionDetails($version_id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::versionDetails_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->versionDetails($version_id);
    }

    public function fillData($id, AddFieldFormResponseRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::view_forms->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->formService->fillData($id, $request);

        return response()->json([
            'message' => __('Created Successfully')
        ]);
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::delete_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->delete($id);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::view_forms->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->findById($id);
    }

    public function create(StoreFormRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::create_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->formService->create($request);
        return response()->json([
            'message' => __('Created Successfully')
        ]);
    }

    public function update($id, UpdateFormRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionForm::edit_form->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->formService->update($id, $request);
    }
}
