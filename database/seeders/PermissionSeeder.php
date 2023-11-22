<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'create.mahasiswa'],
            ['name' => 'create.data'],
            ['name' => 'create.fakultas']
            // Add more permissions as needed
        ];

        // Insert permissions into the database
        foreach ($permissions as $permission) {
            // Permission::create($permission);
        }
    }
}
