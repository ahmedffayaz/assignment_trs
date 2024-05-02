<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    private $permissions = [
        'product-list',
        'product-create',
        'product-edit',
        'product-delete'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
       
        $admin = Role::updateOrCreate(['name' => 'admin']);
       
        $subAdmin =  Role::updateOrCreate(['name' => 'sub_admin']);

        $adminPermissions = Permission::pluck('id');
        $admin->permissions()->sync($adminPermissions);

        $subAdminPermissions = Permission::whereIn('name', ['product-create', 'product-list'])->pluck('id');
        $subAdmin->permissions()->sync($subAdminPermissions);
    }
}
