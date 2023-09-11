<?php

namespace App\Domains\BankAccount\Exports;

use App\Domains\BankAccount\Models\BankAccount;
use App\Domains\BankAccount\Repositories\BankAccountMySqlRepository;
use App\Domains\BankAccount\Resources\BankAccountResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class BankAccountsExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{

    public function collection()
    {
        return app(BankAccountMySqlRepository::class)->list();
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
