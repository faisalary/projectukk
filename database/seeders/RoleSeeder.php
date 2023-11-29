<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// class RoleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $role = ['Admin', 'Applicant'];

//         foreach ($role as $key => $value) {
//             # code...
//             Role::create([
//                 'name' => $value
//             ]);
//         }
//     }
// }

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'guard_name'=> 'web'
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name'=> 'web'
        ]);
        Role::create([
            'name' => 'user',
            'guard_name'=> 'web'
        ]);

    }
}