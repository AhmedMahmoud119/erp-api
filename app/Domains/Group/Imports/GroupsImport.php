<?php

namespace App\Domains\Group\Imports;

use App\Domains\Account\Models\Account;
use App\Domains\Group\Models\Group;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class GroupsImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    private $is_account_parent;


    public function model(array $row)
    {
        if (isset($row["is_account_parent"]) && $row["is_account_parent"] === 1) {
            $this->is_account_parent = 1;
            return new Account([
                'name' => $row['name'],
                'code' => $row['code'],
                'group_id' => $row['group_type_id'],
                'creator_id' => auth()->user()->id,
                'created_at' => now(),
            ]);
        }

        $this->is_account_parent = 0;

        return new Group([
            'name' => $row['name'],
            'code' => $row['code'],
            'group_type_id' => $row['group_type_id'],
            'creator_id' => auth()->user()->id,
            'created_at' => now(),
        ]);
    }

    public function rules(): array
    {
        return [

            'name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            '*.name' => 'required|regex:/^[a-zA-Zگچپژیلفقهكيىموي ء-ي\s]*$/',
            'code' => 'required',
            '*.code' => 'required',
            'group_type_id' => [
                'required',
                Rule::when($this->is_account_parent == 0, ['exists:group_types,id']),
                Rule::when($this->is_account_parent == 1, ['exists:groups,id'])
            ]

        ];
    }
    public function customValidationMessages()
    {
        return [
            'group_type_id.exists' => 'The selected value of row number :attribute does not exists in Groups or Group Types.',
        ];
    }

}
