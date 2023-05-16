<?php

namespace Database\Seeders;

use App\Domains\Company\Models\EnumPermissionCompany;
use App\Domains\Field\Models\EnumPermissionField;
use App\Domains\Form\Models\EnumPermissionForm;
use App\Domains\Module\Models\Module;
use App\Domains\Permission\Models\EnumPermission;
use App\Domains\Permission\Models\EnumPermissionRole;
use App\Domains\Permission\Models\EnumPermissionUser;
use App\Domains\Permission\Models\Permission;
use App\Domains\Tenant\Models\EnumPermissionTenant;
use App\Domains\User\Models\User;
use App\Domains\Role\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        $modules=[
            'Setup' => [
                'Role' => array_column(EnumPermissionRole::cases(), 'value'),
                'Permission' => array_column(EnumPermission::cases(), 'value'),
                'User' => array_column(EnumPermissionUser::cases(), 'value'),
                'Tenant' => array_column(EnumPermissionTenant::cases(), 'value'),
                'Field' => array_column(EnumPermissionField::cases(), 'value'),
                'Form' => array_column(EnumPermissionForm::cases(), 'value'),
                'Company' => array_column(EnumPermissionCompany::cases(), 'value'),
            ]
        ];

        foreach ($modules as $key => $module){
            $moduleModel = Module::firstOrCreate([
                'name' => $key
            ]);

            foreach ($module as $permissionCategoryKey => $permissions){
                $permissionCategoryModel = $moduleModel->permissionCategories()->firstOrCreate([
                    'name' => $permissionCategoryKey
                ]);

                $permissionsMap = array_map(function($permission) use ($permissionCategoryModel) {
                    return [
                        'name' => $permission,
                        'guard_name' => 'api',
                        'permission_category_id' => $permissionCategoryModel->id,
                    ];
                },$permissions);

                foreach ($permissionsMap as $permission)
                    Permission::firstOrCreate($permission);
            }


        }

        Role::firstOrCreate(['name' => 'super-admin','guard_name'=>'api']);
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));// super admin

        User::findOrFail(1)->roles()->sync(1); // super admin

    }
}
