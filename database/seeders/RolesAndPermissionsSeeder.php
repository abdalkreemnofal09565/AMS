<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        Permission::create(['name' => 'create.articles']);
        Permission::create(['name' => 'edit.articles']);
        Permission::create(['name' => 'approve.articles']);
        Permission::create(['name' => 'destroy.articles']);

        Permission::create(['name' => 'create.comment']);
        Permission::create(['name' => 'destroy.comment']);

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('create.articles', 'edit.articles',"destroy.articles", 'approve.articles',"destroy.comment",'create.comment');

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('create.articles', 'edit.articles',"destroy.articles","destroy.comment",'create.comment');
    }
}
