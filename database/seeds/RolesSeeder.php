<?php

use Illuminate\Database\Seeder;
use App\Models\Tenant\Role;
use App\Models\Tenant\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();

        $this->createPermissions();
    }

    private function createRoles()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'student']);
    }

    private function createPermissions()
    {
        Permission::create(['name' => 'create subject']);
        Permission::create(['name' => 'show subject']);
        Permission::create(['name' => 'edit subject']);
        Permission::create(['name' => 'delete subject']);

        Permission::create(['name' => 'create chapter']);
        Permission::create(['name' => 'show chapter']);
        Permission::create(['name' => 'edit chapter']);
        Permission::create(['name' => 'delete chapter']);

        Permission::create(['name' => 'create question']);
        Permission::create(['name' => 'show question']);
        Permission::create(['name' => 'edit question']);
        Permission::create(['name' => 'delete question']);

        Permission::create(['name' => 'create test']);
        Permission::create(['name' => 'show test']);
        Permission::create(['name' => 'edit test']);
        Permission::create(['name' => 'delete test']);

        Permission::create(['name' => 'show student']);
        Permission::create(['name' => 'delete student']);

        Permission::create(['name' => 'take test']);

        Permission::create(['name' => 'show TestQuestion']);
        Permission::create(['name' => 'edit TestQuestion']);

        Permission::create(['name' => 'create tag']);
        Permission::create(['name' => 'show tag']);
        Permission::create(['name' => 'edit tag']);
        Permission::create(['name' => 'delete tag']);
    }
}
