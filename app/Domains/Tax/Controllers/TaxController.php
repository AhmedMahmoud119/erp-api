<?php

namespace App\Domains\Tax\Controllers;

use App\Domains\Tax\Models\EnumPermissionTax;
use App\Domains\Tax\Request\FilterTaxRequest;
use App\Domains\Tax\Request\StoreTaxRequest;
use App\Domains\Tax\Request\UpdateTaxRequest;
use App\Domains\Tax\Resources\TaxResource;
use App\Domains\Tax\Services\TaxService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct(private TaxService $taxService)
    {
    }

    public function list(FilterTaxRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTax::view_taxes->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return TaxResource::collection($this->taxService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTax::delete_tax->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->taxService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTax::view_taxes->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return TaxResource::make($this->taxService->findById($id));
    }

    public function create(StoreTaxRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTax::create_tax->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->taxService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateTaxRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionTax::edit_tax->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->taxService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
}
