<?php

namespace App\Domains\Account\Exports;

use App\Domains\Account\Models\Account;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class AccountsExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{

    public function collection()
    {
        return Account::get();
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->name,
            $data->creator->name ?? null,
            $data->created_at,
            $data->opening_balance,
            $data->current_balance,
            $data->status,
        ];


    }

    public function headings(): array
    {
        return ['Code', 'Name', 'Created By', 'Created Date', 'opening_balance', 'current_balance', 'status'];
    }

    public function registerEvents(): array
    {
        return [

        ];
    }

}
