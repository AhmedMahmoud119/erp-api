<?php

namespace App\Domains\Stock\Repositories;

use App\Domains\Product\Models\Product;
use App\Domains\Stock\Exports\InventorysExport;
use App\Domains\Stock\Interfaces\StockRepositoryInterface;
use App\Domains\Stock\Models\Stock;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StockMySqlRepository implements StockRepositoryInterface
{
    public function __construct(private Stock $stock)
    {
    }
    public function findById(string $id): Stock
    {
        $stock = $this->stock::findOrFail($id);
        $stock->load(['creator', 'product', 'warehouse']);
        return $stock;
    }
    public function list()
    {
        return Stock::when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })->when(request()->selling_price_from, function ($q) {
            $q->where('selling_price', '>=', request()->selling_price_from);
        })->when(request()->selling_price_to, function ($q) {
            $q->where('selling_price', '<=', request()->selling_price_to);
        })->when(request()->purchasing_price_from, function ($q) {
            $q->where('purchasing_price', '>=', request()->purchasing_price_from);
        })->when(request()->purchasing_price_to, function ($q) {
            $q->where('purchasing_price', '<=', request()->purchasing_price_to);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['quantity', 'selling_price', 'purchasing_price', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->with(['creator', 'product', 'warehouse'])
            ->orderBy('quantity')->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->stock::create($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $stock = $this->stock::findOrFail($id);
        $stock->update($request->validated() + [
            'creator_id' => auth()->user()->id,
        ]);
        return true;
    }

    public function inventoryReport()
    {
        $query = $this->stock::when(request()->creator_id, function ($q) {
            return $q->where('creator_id', request()->creator_id);
        })->when(request()->selling_price_to, function ($q) {
            $q->whereRaw('(quantity * selling_price) <= ?', [request()->selling_price_to]);
        })->when(request()->selling_price_from, function ($q) {
            $q->whereRaw('(quantity * selling_price) >= ?', [request()->selling_price_from]);
        })->when(request()->purchasing_price_to, function ($q) {
            $q->whereRaw('(quantity * purchasing_price) <= ?', [request()->purchasing_price_to]);
        })->when(request()->purchasing_price_from, function ($q) {
            $q->whereRaw('(quantity * purchasing_price) >= ?', [request()->purchasing_price_from]);
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->when(request()->warehouse_name, function ($q) {
            $q->whereHas('warehouse', function ($warehouseQuery) {
                $warehouseQuery->where('name', 'like', '%' . request()->warehouse_name . '%');
            });
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['quantity', 'created_at', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->with('warehouse')->paginate(request('limit', config('app.pagination_count')));
        return $query;
    }

    public function exportInventoryReport()
    {
        $fileName = 'inventory_report_' . Carbon::now()->format('YmdHis') . '.xlsx';

        (new InventorysExport())->queue($fileName)->chain([
            logger('Inventory Report Exported'),
        ]);

        return true;
    }
    public function generatePDF()
    {
        $report = $this->inventoryReport();
        $data = [
            'title' => 'Inventory Report',
            'date' => date('m/d/Y'),
            'inventoryReport' => $report,
        ];
        $pdf = PDF::loadView('InventoryReportPDF', $data);

        $path = public_path('storage/');
        $fileName = time() . '-inventory-report.pdf';
        $pdf->save($path . $fileName);

        return response()->json([
            'file_path' => asset('storage/' . $fileName),
        ]);
        // return true;
    }

    public function delete(string $id): bool
    {
        $this->stock::findOrFail($id)?->delete();

        return true;
    }

}
