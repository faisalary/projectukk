<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = User::firstOrNew([
            'email' => 'administrator@gmail.com',
            'username' => 'administrator'
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('password'),
        ]);

        if (!$administrator->exists) {
            $administrator->save();
            $administrator->assignRole('Administrator');
        }
        
        // $superadmin = User::firstOrNew([
        //     'email' => 'superadmin@gmail.com',
        //     'username' => 'SuperAdmin'
        // ], [
        //     'name' => 'Super Admin Role',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 0
        // ]);

        // if (!$superadmin->exists) {
        //     $superadmin->save();
        //     $superadmin->assignRole('Super Admin');
        // }

        
        // $admin = User::firstOrNew([
        //         'email' => 'admin@role.test',
        //         'username' => 'Admin'
        // ], [
        //     'name' => 'Admin',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 1
        // ]);

        // if (!$admin->exists) {
        //     $admin->save();
        //     $admin->assignRole('admin');
        // }

        
        // $user = User::firstOrNew([
        //     'email' => 'user@role.test',
        //     'username' => 'User'
        // ], [
        //     'name' => 'User Role',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 2
        // ]);

        // if (!$user->exists) {
        //     $user->save();
        //     $user->assignRole('user');
        // }
    }
}
