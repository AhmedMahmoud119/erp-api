<?php

namespace App\Domains\Company\Controllers;

use App\Domains\Company\Models\EnumPermissionCompany;
use App\Domains\Company\Request\StoreCompanyRequest;
use App\Domains\Company\Request\UpdateCompanyRequest;
use App\Domains\Company\Resources\CompanyResource;
use App\Domains\Company\Services\CompanyService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCompany::view_companies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  CompanyResource::collection($this->companyService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCompany::delete_company->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->companyService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCompany::view_companies->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompanyResource($this->companyService->findById($id));
    }

    public function create(StoreCompanyRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCompany::create_company->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->companyService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateCompanyRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionCompany::edit_company->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->companyService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }

}
