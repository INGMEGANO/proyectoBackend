<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating roles
        $role1= Role::create(['name'=>'employee']);
        $role2= Role::create(['name'=>'admin']);
        $role3= Role::create(['name'=>'manager']);

        //creating permissions for employees
        Permission::create(['name'=>'submit.hours'])->syncRoles([$role1]);
        Permission::create(['name'=>'view.hours.submitted'])->syncRoles([$role1]);

        //creating permissions for admins
        Permission::create(['name' => 'view.employees.list'])->syncRoles([$role2,$role3]);
		Permission::create(['name' => 'view.employees.information'])->syncRoles([$role2,$role3]);
        Permission::create(['name' => 'associate.employees.manager'])->syncRoles([$role2,$role3]);

        //creating permissions for managers
        Permission::create(['name' => 'create.employees'])->syncRoles([$role3,$role2]);
		Permission::create(['name' => 'retrieve.employees'])->syncRoles([$role3,$role2]);
		Permission::create(['name' => 'update.employees'])->syncRoles([$role3,$role2]);
		Permission::create(['name' => 'delete.employees'])->syncRoles([$role3,$role2]);
        Permission::create(['name' => 'get.own.employees.list'])->syncRoles([$role3]);

    }
}
