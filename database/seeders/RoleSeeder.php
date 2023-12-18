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
        
    $superadminRole = Role::where('name', 'superadmin')->first();
    if (!$superadminRole) {
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);
    }

    
    $adminRole = Role::where('name', 'admin')->first();
    if (!$adminRole) {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
    }

   
    $userRole = Role::where('name', 'user')->first();
    if (!$userRole) {
        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
    }
}
}