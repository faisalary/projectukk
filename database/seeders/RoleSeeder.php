<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $administrator = Role::where('name', 'Administrator')->first();
    if (!$administrator) {
        Role::create([
            'name' => 'Administrator',
            'guard_name' => 'web'
        ]);
    }

    // $superadminRole = Role::where('name', 'Super Admin')->first();
    // if (!$superadminRole) {
    //     Role::create([
    //         'name' => 'Super Admin',
    //         'guard_name' => 'web'
    //     ]);
    // }

    
    // $adminRole = Role::where('name', 'Admin')->first();
    // if (!$adminRole) {
    //     Role::create([
    //         'name' => 'Admin',
    //         'guard_name' => 'web'
    //     ]);
    // }

   
    // $userRole = Role::where('name', 'User')->first();
    // if (!$userRole) {
    //     Role::create([
    //         'name' => 'User',
    //         'guard_name' => 'web'
    //     ]);
    // }
}
}