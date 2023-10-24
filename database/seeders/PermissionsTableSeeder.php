<?php

namespace Database\Seeders;

use App\Domains\Account\Models\EnumPermissionAccount;
use App\Domains\BankAccount\Models\EnumPermissionBankAccount;
use App\Domains\CashManagment\Models\EnumPermissionCashManagment;
use App\Domains\Category\Models\EnumPermissionCategory;
use App\Domains\Company\Models\EnumPermissionCompany;
use App\Domains\Currency\Models\EnumPermissionCurrency;
use App\Domains\Customer\Models\EnumPermissionCustomer;
use App\Domains\Field\Models\EnumPermissionField;
use App\Domains\FinancialPeriod\Models\EnumPermissionFinancialPeriod;
use App\Domains\FixedAsset\Models\EnumPermissionFixedAsset;
use App\Domains\Form\Models\EnumPermissionForm;
use App\Domains\Group\Models\EnumPermissionGroup;
use App\Domains\GroupType\Models\EnumPermissionGroupType;
use App\Domains\JournalEntry\Models\EnumPermissionJournalEntry;
use App\Domains\Module\Models\Module;
use App\Domains\PaymentType\Models\EnumPermissionPaymentType;
use App\Domains\Permission\Models\EnumPermission;
use App\Domains\Permission\Models\EnumPermissionRole;
use App\Domains\Permission\Models\EnumPermissionUser;
use App\Domains\Permission\Models\Permission;
use App\Domains\Permission\Models\PermissionCategory;
use App\Domains\RevisionHistory\Models\EnumPermissionRevisionHistory;
use App\Domains\Role\Models\Role;
use App\Domains\SafeMovement\Models\EnumPermissionSafeMovement;
use App\Domains\Supplier\Models\EnumPermissionSupplier;
use App\Domains\Purchase\Models\EnumPermissionPurchase;
use App\Domains\Tax\Models\EnumPermissionTax;
use App\Domains\Tenant\Models\EnumPermissionTenant;
use App\Domains\UnitType\Models\EnumPermissionUnitType;
use App\Domains\User\Models\User;
use App\Domains\Vendor\Models\EnumPermissionLocation;
use App\Domains\Vendor\Models\EnumPermissionVendor;
use App\Domains\Warehouse\Models\EnumPermissionWarehouse;
use Illuminate\Database\Seeder;
use App\Domains\Product\Models\EnumPermissionProduct;
use App\Domains\Stock\Models\EnumPermissionStock;
use App\Domains\Pack\Models\EnumPermissionPack;

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
                'UnitType'        => array_column(EnumPermissionUnitType::cases(), 'value'),
                'Vendor'          => array_column(EnumPermissionVendor::cases(), 'value'),
                'Supplier'        => array_column(EnumPermissionSupplier::cases(), 'value'),
                'Customer'        => array_column(EnumPermissionCustomer::cases(), 'value'),
                'Location'        => array_column(EnumPermissionLocation::cases(), 'value'),
                'Category'        => array_column(EnumPermissionCategory::cases(), 'value'),
                'Warehouse'       => array_column(EnumPermissionWarehouse::cases(), 'value'),
                'PaymentType'     => array_column(EnumPermissionPaymentType::cases(), 'value'),
                'Product'         => array_column(EnumPermissionProduct::cases(), 'value'),
                'Stock'           => array_column(EnumPermissionStock::cases(), 'value'),
                'Purchase'        => array_column(EnumPermissionPurchase::cases(), 'value'),
                'Pack'            => array_column(EnumPermissionPack::cases(), 'value'),
                'FixedAsset'      => array_column(EnumPermissionFixedAsset::cases(), 'value'),
                'SafeMovement'    => array_column(EnumPermissionSafeMovement::cases(), 'value'),
                'CashManagment'    => array_column(EnumPermissionCashManagment::cases(), 'value'),
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
