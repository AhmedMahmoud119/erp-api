<?php

namespace App\Domains\Group\Exports;

use App\Domains\Group\Models\Group;
use App\Domains\Group\Resources\GroupResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class GroupsExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{


    public function collection()
    {
        return GroupResource::collection( Group::with('creator','group_type')->get());

    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->name,
            $data->group_type->name??null,
            $data->creator->name??null,
            $data->created_at,
            $data->parent,

        ];


    }

    public function headings(): array
    {
        return ['Code','Name','Group Type','Created By','Created Date','Parent'];
    }


    public function registerEvents(): array
    {
        return [

        ];
    }

}
