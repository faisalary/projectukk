<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission['Super Admin'] = ['roles.view', 'kelola_semua_pengguna.view'];
        $permission['LKM'] = [
            // admin lkm 
            'dashboard.dashboard_admin',
            'kelola_mitra.view',
            'informasi_lowongan_lkm.view', //
            'kelola_lowongan_lkm.view',//
            'kelola_lowongan_lkm.approval',
            'pengajuan_magang.view',//
            'data_magang.view',
            'jadwal_seleksi_lkm.view',
            'berkas_magang_fakultas.view',
            'berkas_magang_mandiri.view',
            'nilai_mahasiswa_magang_fakultas.view',
            'nilai_mahasiswa_magang_mandiri.view',
            'logbook_magang_fakultas.view',
            'logbook_magang_mandiri.view',
            'kelola_pengguna.view',
            // master data
            'universitas.view',
            'fakultas.view',
            'program_studi.view',
            'tahun_akademik.view',
            'jenis_magang.view',
            'dosen.view',
            'mahasiswa.view',
            'wilayah.view',
            // 'pegawai_industri.view',
            'nilai_mutu.view',
            'nilai_akhir.view',
            'komponen_penilaian.view',
            'dokumen_syarat.view',
            'pembimbing_lapangan_mandiri.view',
        ];

        $permission['Mitra'] = [
            // mitra
            'dashboard.dashboard_mitra',
            'informasi_lowongan_mitra.view', //
            'kelola_lowongan_mitra.view', //
            'anggota_tim.view',
            'jadwal_seleksi_mitra.view',
            // profile perusahaan
            'profile_perusahaan.view',
            'profile_perusahaan.update',
            //-------------------
            'assign_pembimbing.view',
            'template_email.view'
        ];

        $permission['Pembimbing Lapangan'] = [
            'kelola_magang_pemb_lapangan.view',
            'profile_perusahaan.view'
        ];
        $permission['Mahasiswa'] = [];
        $permission['Dosen'] = [
            // approval mahasiswa
            'approval_mhs_doswal.view',
            'data_mahasiswa_magang_dosen.view', 
            'kelola_mhs_pemb_akademik.view'
        ];
        $permission['Kaprodi'] = [
            'approval_mhs_kaprodi.view',
            'data_mahasiswa_magang_kaprodi.view'
        ];

        foreach ($permission as $key => $value) {
            foreach ($value as $p) {
                Permission::findOrCreate($p, 'web');
            }
            $role = Role::findOrCreate($key, 'web');
            $role->syncPermissions($value);
        }
        
        $role = Role::findOrCreate('Super Admin', 'web');

        $permission['Super Admin'] = array_merge($permission['Super Admin'], $permission['LKM']);
        $role->syncPermissions($permission['Super Admin']);

        Artisan::call('cache:clear');
    }
}
