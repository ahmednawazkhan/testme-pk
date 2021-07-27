<?php

use App\Models\User;
use App\Models\Tenant\Role;
use Illuminate\Database\Seeder;
use App\Models\Tenant\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Super admin']);
        $role->syncPermissions(Permission::all());

        $user = User::create(
            [
                'name' => 'Admin User',
                'email' => 'admin@testme.pk',
                'email_verified_at' => now(),
                'password' => bcrypt('secret'), // secret
                'remember_token' => str_random(10),
            ]
        );

        $user->assignRole('Super admin');
        $user->save();
    }
}
