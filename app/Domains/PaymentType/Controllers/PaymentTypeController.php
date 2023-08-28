<?php

namespace App\Domains\PaymentType\Controllers;

use App\Domains\PaymentType\Models\EnumPermissionPaymentType;
use App\Domains\PaymentType\Request\StorePaymentTypeRequest;
use App\Domains\PaymentType\Request\UpdatePaymentTypeRequest;
use App\Domains\PaymentType\Resources\PaymentTypeResource;
use App\Domains\PaymentType\Services\PaymentTypeService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function __construct(private PaymentTypeService $paymentTypeService)
    {
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPaymentType::view_paymentType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return  PaymentTypeResource::collection($this->paymentTypeService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPaymentType::delete_paymentType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->paymentTypeService->delete($id);
        return response()->json([
            'message' => __('Deleted Successfully'),
            'status' => true,
        ], 200);
    }

    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPaymentType::view_paymentType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentTypeResource($this->paymentTypeService->findById($id));
    }

    public function create(StorePaymentTypeRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPaymentType::create_paymentType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->paymentTypeService->create($request);
        return response()->json([
            'message' => __('Created Successfully'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdatePaymentTypeRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionPaymentType::edit_paymentType->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->paymentTypeService->update($id, $request);
        return response()->json([
            'message' => __('Updated Successfully'),
            'status' => true,
        ], 200);
    }
}
