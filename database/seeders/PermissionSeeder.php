<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = [
            [
                //lkm
                'name' => 'superadmin',
                'guard_name' => 'web',
                'permissions' => [
                    'only.lkm.mitra',
                    'only.lkm',
                    'slidebar.lkm',
                    'create.mahasiswa',
                    'create.industri',
                    'view.industri',
                    'edit.industri',
                    'status.industri',
                    'view.fakultas',
                    'edit.fakultas',
                    'status.fakultas',
                    'create.fakultas',
                    'table.informasi.admin',
                    'edit.status.candidate',
                    'chekbox.tabel',
                    'information.title',
                    'edit.actions',
                    'agree.and.reject.buttons',
                    'approval.page',
                    'can.view.data.table',
                    'title.info.lowongan.admin',
                    'ubah.lowongan.admin'
                ]
            ],
            [
                //mitra
                'name' => 'admin',
                'guard_name' => 'web',
                'permissions' => [
                    'only.lkm.mitra',
                    'only.mitra',
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
                    'button.tnglbts.mitra',
                    'title.info.lowongan.mitra',
                    'ubah.lowongan.mitra'
                ]
            ],
            [
                //mahasiswa
                'name' => 'user',
                'guard_name' => 'web'
            ],
        ];

        foreach ($role as $key => $value) {
            $role = Role::findOrCreate($value['name'], $value['guard_name']);

            if (isset($value['permissions'])) {
                foreach ($value['permissions'] as $k => $v) {
                    
                    $permission = Permission::findOrCreate($v);
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
