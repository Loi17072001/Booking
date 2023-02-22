<?php

use Illuminate\Database\Seeder;
use App\Laravue\Acl;
use App\Laravue\Models\Role;
use App\Laravue\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'account' => 'admin',
            'phone' => '000000000',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123123'),
        ]);
        $adminRole = Role::findByName(\App\Laravue\Acl::ROLE_ADMIN);
        $admin->syncRoles($adminRole);
    }
}
