<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $superadmin = User::create([
        //     'name' => 'Super Admin Role',
        //     'username' => 'SuperAdmin',
        //     'email' => 'superadmin@demo.test',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 0
        // ]);
        // $superadmin->assignRole('superadmin');
        
        // $admin = User::create([
        //     'name' => 'Admin Role',
        //     'username' => 'Admin',
        //     'email' => 'admin@role.test',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 1
        // ]);
        // $admin->assignRole('admin');

        // $user = User::create([
        //     'name' => 'User Role',
        //     'username' => 'User',
        //     'email' => 'user@role.test',
        //     'password' => bcrypt('12345678'),
        //     'isAdmin' => 2
        // ]);
        // $user->assignRole('user');
    }
}
