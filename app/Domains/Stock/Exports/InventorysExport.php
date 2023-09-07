<?php

namespace App\Domains\Stock\Exports;

use App\Domains\Stock\Repositories\StockMySqlRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class InventorysExport implements FromCollection, WithMapping, WithHeadings, WithEvents, ShouldQueue
{
    use Exportable;

    public function collection()
    {
        return app(StockMySqlRepository::class)->inventoryReport();
    }

    public function map($data): array
    {
        return [
            $data->warehouse->name,
            $data->quantity,
            ($data->selling_price * $data->quantity),
            ($data->purchasing_price * $data->quantity)
        ];
    }

    public function headings(): array
    {
        return [
            'Warehouse Name',
            'Number Of Products',
            'Total Purchasing Price',
            'Total Selling Price',
        ];
    }

    public function registerEvents(): array
    {
        return [];
    }
}