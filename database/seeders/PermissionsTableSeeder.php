<?php

namespace Database\Seeders;

use App\Domains\Account\Models\EnumPermissionAccount;
use App\Domains\BankAccount\Models\EnumPermissionBankAccount;
use App\Domains\Company\Models\EnumPermissionCompany;
use App\Domains\Currency\Models\EnumPermissionCurrency;
use App\Domains\Customer\Models\EnumPermissionCustomer;
use App\Domains\Field\Models\EnumPermissionField;
use App\Domains\FinancialPeriod\Models\EnumPermissionFinancialPeriod;
use App\Domains\Form\Models\EnumPermissionForm;
use App\Domains\Group\Models\EnumPermissionGroup;
use App\Domains\GroupType\Models\EnumPermissionGroupType;
use App\Domains\JournalEntry\Models\EnumPermissionJournalEntry;
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
use App\Domains\Vendor\Models\EnumPermissionVendor;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {


        $modules = [
            'Setup' => [
                'Role'       => array_column(EnumPermissionRole::cases(), 'value'),
                'Permission' => array_column(EnumPermission::cases(), 'value'),
                'User'       => array_column(EnumPermissionUser::cases(), 'value'),
                'Tenant'     => array_column(EnumPermissionTenant::cases(), 'value'),
                'Field'      => array_column(EnumPermissionField::cases(), 'value'),
                'Form'       => array_column(EnumPermissionForm::cases(), 'value'),
                'Company'    => array_column(EnumPermissionCompany::cases(), 'value'),
            ],

            'Accounting' => [
                'Currency'        => array_column(EnumPermissionCurrency::cases(), 'value'),
                'BankAccount'     => array_column(EnumPermissionBankAccount::cases(), 'value'),
                'Tax'             => array_column(EnumPermissionTax::cases(), 'value'),
                'RevisionHistory' => array_column(EnumPermissionRevisionHistory::cases(), 'value'),
                'GroupType'       => array_column(EnumPermissionGroupType::cases(), 'value'),
                'Group'           => array_column(EnumPermissionGroup::cases(), 'value'),
                'Account'         => array_column(EnumPermissionAccount::cases(), 'value'),
                'JournalEntry'    => array_column(EnumPermissionJournalEntry::cases(), 'value'),
                'FinancialPeriod' => array_column(EnumPermissionFinancialPeriod::cases(), 'value'),
                'Vendor'          => array_column(EnumPermissionVendor::cases(), 'value'),
                'Customer'        => array_column(EnumPermissionCustomer::cases(), 'value'),
            ],

        ];


        foreach ($modules as $key => $module) {
            $moduleModel = Module::firstOrCreate([
                'name' => $key,
            ]);

            foreach ($module as $permissionCategoryKey => $permissions) {
                $permissionCategoryModel = $moduleModel->permissionCategories()->firstOrCreate([
                    'name' => $permissionCategoryKey,
                ]);

                $permissionsMap = array_map(function ($permission) use ($permissionCategoryModel) {
                    return [
                        'name'                   => $permission,
                        'guard_name'             => 'api',
                        'permission_category_id' => $permissionCategoryModel->id,
                    ];
                }, $permissions);

                foreach ($permissionsMap as $permission) {
                    Permission::firstOrCreate($permission);
                }
            }
        }

        Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'api']);
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id')); // super admin

        User::findOrFail(1)->roles()->sync(1); // super admin


    }
}
