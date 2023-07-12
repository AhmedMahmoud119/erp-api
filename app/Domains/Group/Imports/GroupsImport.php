<?php

namespace App\Domains\Group\Imports;
use App\Domains\Group\Models\Group;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class GroupsImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;


    public function model(array $row)
    {

        return new Group([
            'name' => $row['name'],
            'code' => $row['code'],
            'parent' => $row['parent'],
            'group_type_id' => $row['group_type_id'],
            'creator_id' => auth()->user()->id,
            'created_at' =>now(),
        ]);
    }

    public function rules(): array
    {
        return [

            'name' => 'required',
            '*.name' => 'required',
            'code' => 'required',
            '*.code' => 'required',
            'group_type_id' => 'required',
            '*.group_type_id' => 'required',

        ];
    }

}
