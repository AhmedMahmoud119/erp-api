<?php

namespace Database\Seeders;

use App\Domains\BankAccount\Models\EnumPermissionBankAccount;
use App\Domains\Company\Models\EnumPermissionCompany;
use App\Domains\Currency\Models\EnumPermissionCurrency;
use App\Domains\Field\Models\EnumPermissionField;
use App\Domains\Form\Models\EnumPermissionForm;
use App\Domains\Module\Models\Module;
use App\Domains\Permission\Models\EnumPermission;
use App\Domains\Permission\Models\EnumPermissionRole;
use App\Domains\Permission\Models\EnumPermissionUser;
use App\Domains\Permission\Models\Permission;
use App\Domains\Permission\Models\PermissionCategory;
use App\Domains\RevisionHistory\Models\EnumPermissionRevisionHistory;
use App\Domains\Role\Models\Role;
use App\Domains\Tax\Models\EnumPermissionTax;
use App\Domains\Tenant\Models\EnumPermissionTenant;
use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {

        $modules = [
            ['name' => 'Setup'],
            ['name' => 'Accountant'],
        ];
        Module::insert($modules);

        $setup = [
            //setup
            ['name' => 'Role', 'module_id' => 1],
            ['name' => 'Permission', 'module_id' => 1],
            ['name' => 'User', 'module_id' => 1],
            ['name' => 'Tenant', 'module_id' => 1],
            ['name' => 'Field', 'module_id' => 1],
            ['name' => 'Form', 'module_id' => 1],
            ['name' => 'Company', 'module_id' => 1],

            //Accountant

            ['name' => 'Currency', 'module_id' => 2],
            ['name' => 'BankAccount', 'module_id' => 2],
            ['name' => 'Tax', 'module_id' => 2],
            ['name' => 'RevisionHistory', 'module_id' => 2],
        ];
        PermissionCategory::insert($setup);

        $EnumPermissions = [
            array_column(EnumPermissionRole::cases(), 'value'),
            array_column(EnumPermission::cases(), 'value'),
            array_column(EnumPermissionUser::cases(), 'value'),
            array_column(EnumPermissionTenant::cases(), 'value'),
            array_column(EnumPermissionField::cases(), 'value'),
            array_column(EnumPermissionForm::cases(), 'value'),
            array_column(EnumPermissionCompany::cases(), 'value'),
            array_column(EnumPermissionCurrency::cases(), 'value'),
            array_column(EnumPermissionBankAccount::cases(), 'value'),
            array_column(EnumPermissionTax::cases(), 'value'),
            array_column(EnumPermissionRevisionHistory::cases(), 'value'),
        ];

        foreach ($EnumPermissions as $key => $EnumPermission) {
            $permissions = array_map(function ($permission) use ($key) {
                $d = explode(' ', $permission);

                return [
                    'name' => $permission,
                    'guard_name' => 'api',
                    'permission_category_id' => $key + 1,
                ];
            }, $EnumPermission);
            Permission::insert($permissions);
        }

        Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'api']);
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id')); // super admin

        User::findOrFail(1)->roles()->sync(1); // super admin

    }
}
