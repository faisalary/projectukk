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
        $permission['LKM'] = [
            // admin lkm 
            'dashboard.dashboard_admin',
            'kelola_mitra.view',
            'informasi_lowongan_lkm.view',
            'kelola_lowongan_lkm.view',
            'pengajuan_magang.view',
            'data_magang.view',
            'jadwal_seleksi_lkm.view',
            'berkas_magang_fakultas.view',
            'berkas_magang_mandiri.view',
            'nilai_mahasiswa_magang_fakultas.view',
            'nilai_mahasiswa_magang_mandiri.view',
            'logbook_magang_fakultas.view',
            'logbook_magang_mandiri.view',
            'kelola_pengguna.view',
            'roles.view',
            // master data
            'universitas.view',
            'fakultas.view',
            'program_studi.view',
            'tahun_akademik.view',
            'jenis_magang.view',
            'dosen.view',
            'mahasiswa.view',
            'pegawai_industri.view',
            'nilai_mutu.view',
            'komponen_penilaian.view',
            'dokumen_syarat.view',
            'pembimbing_lapangan_mandiri.view',
        ];

        $permission['Mitra'] = [
            // mitra
            'dashboard.dashboard_mitra',
            'informasi_lowongan_mitra.view',
            'kelola_lowongan_mitra.view',
            'anggota_tim.view',
        ];

        $permission['Pembimbing Lapangan'] = [];

        foreach ($permission as $key => $value) {
            foreach ($value as $p) {
                Permission::findOrCreate($p, 'web');
            }
            $role = Role::findOrCreate($key, 'web');
            $role->givePermissionTo($value);
        }
        
        $role = Role::findOrCreate('Super Admin', 'web');
        $role->givePermissionTo(Permission::all());
    }
}
