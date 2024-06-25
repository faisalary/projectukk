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
        $administrator = Role::where('name', 'Super Admin')->first();
        $permission = [
            'dashboard.dashboard_admin',
            'dashboard.dashboard_mitra',
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

        foreach ($permission as $key => $value) {
            $permission = Permission::findOrCreate($value);
            $administrator->givePermissionTo($permission);
        }
    }
}
