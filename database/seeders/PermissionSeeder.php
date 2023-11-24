<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\Models\Role as ModelsRole;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $role = [
            [
                'name' => 'superadmin',
                'guard_name'=> 'web',
                'permissions' => [
                    'slidebar.lkm',
                    'create.mahasiswa',
                    'create.fakultas',
                    'table.informasi.admin',
                    'edit.status.candidate',
                    'chekbox.tabel',
                    'information.title',
                    'edit.actions',
                    'agree.and.reject.buttons',
                    'approval.page',
                    'can.view.data.table'
                ]
            ],
            [
                'name' => 'admin',
                'guard_name'=> 'web',
                'permissions' => [
                    'slidebar.mitra',
                    'information.vacancies',
                    'confirmation.limit',
                    'edit.status.candidate',
                    'chekbox.tabel',
                    'information.title',
                    'tab.title',
                    'agree.and.reject.buttons',
                    'approval.page',
                    'button.submit.improvement',
                    'create.data',
                    'edit.data.table',
                    'delete.data.table',                    
                ]
            ],
            [
                'name' => 'user',
                'guard_name'=> 'web'
            ],
        ];

        foreach ($role as $key => $value) {
            $role = Role::findOrCreate($value['name'], $value['guard_name']);

            if (isset($value['permissions'])) {
                foreach ($value['permissions'] as $k => $v) {
                    # code...
                    $permission = Permission::findOrCreate($v);
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
