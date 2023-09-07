<?php

namespace App\Domains\Stock\Controllers;

use App\Domains\Stock\Models\EnumPermissionStock;
use App\Domains\Stock\Request\StoreStockRequest;
use App\Domains\Stock\Request\UpdateStockRequest;
use App\Domains\Stock\Resources\InventoryReportResource;
use App\Domains\Stock\Resources\StockResource;
use App\Domains\Stock\Services\StockService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(private StockService $stockService)
    {
    }
    public function findById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::view_stocks->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new StockResource($this->stockService->findById($id));
    }

    public function list()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::view_stocks->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return StockResource::collection($this->stockService->list());
    }

    public function delete($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::delete_stock->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->stockService->delete($id);
        return response()->json([
            'message' => __('Stock deleted successfully!'),
            'status' => true,
        ], 200);
    }

    public function create(StoreStockRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::create_stock->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->stockService->create($request);
        return response()->json([
            'message' => __('Stock created successfully!'),
            'status' => true,
        ], 200);
    }

    public function update($id, UpdateStockRequest $request)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::edit_stock->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->stockService->update($id, $request);
        return response()->json([
            'message' => __('Stock information updated successfully!'),
            'status' => true,
        ], 200);
    }

    public function inventoryReport()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::view_reports->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return InventoryReportResource::collection($this->stockService->inventoryReport());
    }
    public function exportFile($extension)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionStock::export_report_file->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->stockService->exportFile($extension);
        return response()->json([
            'message' => __('We are processing your request, you will receive an email once completed.'),
            'status' => true,
        ], Response::HTTP_OK);


    }

}