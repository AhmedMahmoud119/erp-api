<?php

namespace App\Domains\User\Exports;

use App\Domains\User\Models\User;
use App\Domains\User\Resources\UserResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class UsersExport implements FromCollection, WithMapping, WithHeadings, WithEvents
{


    public function collection()
    {
        return UserResource::collection( User::get());

    }

    public function map($data): array
    {
        return [
            $data->name,
            $data->email,
            $data->phone,
            $data->creator->name??'',
            $data->parent->name??'',
            $data->roles->first()->name??'',
            $data->status,
        ];
    }

    public function headings(): array
    {
        return ['name','email','phone','creator','parent','role','status'];
    }


    public function registerEvents(): array
    {
        return [

        ];
    }

}
