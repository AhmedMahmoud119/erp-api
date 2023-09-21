<?php

namespace App\Domains\Customer\Exports;

use App\Domains\Customer\Repositories\CustomerMySqlRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class SalesReportExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{

    public function collection()
    {
        return app(CustomerMySqlRepository::class)->salesReport(request());
    }

    public function map($data): array
    {
        return [
            $data->name,
            $data->purchase_sum_total,
        ];


    }

    public function headings(): array
    {
        return ['Name', 'Purchase Total'];
    }

    public function registerEvents(): array
    {
        return [

        ];
    }

}
