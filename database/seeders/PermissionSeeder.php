<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'manage all users']);

        $admin =   Role::create(['name' => 'admin']);
        // $admin->givePermissionTo('manage all users');

        Role::create(['name' => 'user']);
    }
}
