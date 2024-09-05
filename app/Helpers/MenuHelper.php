<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class MenuHelper
{

    public static function getInstance()
    {
        $user = auth()->user();
        if (!Cache::has('data_menu_'. $user->roles[0]->name)) {
            $data = self::getMenu();
            $getUserPermission = $user->roles[0]->permissions->pluck('name')->toArray();
            $getUserRole = $user->roles[0]->name;
            $data = self::menuFilter($data, $getUserPermission, $getUserRole);
            Cache::forever('data_menu_'. $user->roles[0]->name, $data);
        }

        $data = Cache::get('data_menu_'. $user->roles[0]->name);
        $data = self::specialCase($data);
        $result = self::menuMaker($data);

        return $result;
    }

    private static function specialCase($data) {
        $user = auth()->user();
        if ($user->hasAnyRole(['Dosen', 'Kaprodi']) && !$user->can('permission:data_mahasiswa_magang_kaprodi.view') && count($user->dosen->mahasiswaBimbingan) == 0) {
            $data = array_filter($data, function($item) {
                return (isset($item['name']) && $item['name'] != 'Pembimbing Akademik') && (isset($item['permission']) && $item['permission'] != 'kelola_mhs_pemb_akademik.view');
            });
        }
        return $data;
    }

    private static function menuFilter($data, $getUserPermission, $getUserRole = null) {
        foreach ($data as $key => $value) {
            if (isset($value['type']) && $value['type'] == 'menu-header') {
                if (is_array($value['role']) && !in_array($getUserRole, $value['role'])) {
                    unset($data[$key]);
                } else if (is_string($value['role']) && $value['role'] != $getUserRole) {
                    unset($data[$key]);
                }
            } else if (isset($value['submenu'])) {
                $data[$key]['submenu'] = self::menuFilter($value['submenu'], $getUserPermission);
                if (empty($data[$key]['submenu'])) {
                    unset($data[$key]);
                }
            } else {
                if (!in_array($value['permission'], $getUserPermission)) {
                    unset($data[$key]);
                }
            }
        }

        return $data;
    }

    private static function menuMaker($data)
    {
        $menu = '';
        foreach ($data as $key => $value) {
            if (isset($value['type']) && $value['type'] == 'menu-header') {
                $menu .= '<li class="menu-header small text-uppercase">';
                $menu .= '<span class="menu-header-text">' . $value['name'] . '</span>';
                $menu .= '</li>';
            } elseif (isset($value['submenu'])) {
                $submenu = '';
                $menuDefault = '<li class="menu-item">';
                $menuActived = false;

                foreach ($value['submenu'] as $key => $value2) {
                    if (request()->routeIs($value2['route'] . '*') && $menuActived == false) {
                        $menuDefault = '<li class="menu-item active open">';
                        $menuActived = true;
                    }

                    $submenu .= '<li class="menu-item ' . (request()->routeIs($value2['route'] . '*') ? 'active' : '') . '">';
                    $submenu .= '<a href="' . route($value2['route']) . '" class="menu-link">';
                    $submenu .= '<div>' . $value2['name'] . '</div>';
                    $submenu .= '</a>';
                    $submenu .= '</li>';
                }

                $menu .= $menuDefault;
                $menu .= '<a href="javascript:void(0);" class="menu-link menu-toggle">';
                $menu .= '<i class="menu-icon tf-icons ti ' . $value['icon'] . '"></i>';
                $menu .= '<div>' . $value['name'] . '</div>';
                $menu .= '</a>';
                $menu .= '<ul class="menu-sub">';

                $menu .= $submenu;

                $menu .= '</ul>';
                $menu .= '</li>';
            } else {
                $menu .= '<li class="menu-item ' . (request()->routeIs($value['route'] . '*') ? 'active' : '') . '">';
                $menu .= '<a href="' . route($value['route']) . '" class="menu-link">';
                $menu .= '<i class="menu-icon tf-icons ti ' . $value['icon'] . '"></i>';
                $menu .= '<div>' . $value['name'] . '</div>';
                $menu .= '</a>';
                $menu .= '</li>';
            }
        }

        return $menu;
    }

    private static function getMenu()
    {
        return [
            [
                'type' => 'menu-header',
                'name' => 'Dashboard Admin',
                'role' => ['Super Admin', 'LKM']
            ],
            [
                'name' => 'Dashboard',
                'route' => 'dashboard_admin',
                'icon' => 'ti-device-desktop-analytics',
                'permission' => 'dashboard.dashboard_admin'
            ],
            [
                'name' => 'Kelola Mitra',
                'route' => 'kelola_mitra',
                'icon' => 'ti-building',
                'permission' => 'kelola_mitra.view'
            ],
            [
                'name' => 'Lowongan Magang',
                'icon' => 'ti-briefcase',
                'submenu' => [
                    [
                        'name' => 'Informasi Lowongan',
                        'route' => 'lowongan.informasi',
                        'permission' => 'informasi_lowongan_lkm.view'
                    ],
                    [
                        'name' => 'Kelola Lowongan',
                        'route' => 'lowongan.kelola',
                        'permission' => 'kelola_lowongan_lkm.view'
                    ],
                ]
            ],
            [
                'name' => 'Pengajuan Magang',
                'route' => 'pengajuan_magang',
                'icon' => 'ti-files',
                'permission' => 'pengajuan_magang.view'
            ],
            [
                'name' => 'Data Mahasiswa Magang',
                'route' => 'data_mahasiswa',
                'icon' => 'ti-file-analytics',
                'permission' => 'data_magang.view'
            ],
            [
                'name' => 'Jadwal Seleksi',
                'route' => 'jadwal_seleksi_lkm',
                'icon' => 'ti-clock',
                'permission' => 'jadwal_seleksi_lkm.view'
            ],
            [
                'name' => 'Berkas Akhir Magang',
                'icon' => 'ti-folder',
                'submenu' => [
                    [
                        'name' => 'Magang Fakultas',
                        'route' => 'berkas_akhir_magang.fakultas',
                        'permission' => 'berkas_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'berkas_akhir_magang.mandiri',
                        'permission' => 'berkas_magang_mandiri.view'
                    ],
                ]
            ],
            [
                'name' => 'Nilai Mahasiswa',
                'icon' => 'ti-medal',
                'submenu' => [
                    [
                        'name' => 'Magang Fakultas',
                        'route' => 'nilai_mahasiswa.fakultas',
                        'permission' => 'nilai_mahasiswa_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'nilai_mahasiswa.mandiri',
                        'permission' => 'nilai_mahasiswa_magang_mandiri.view'
                    ],
                ]
            ],
            [
                'name' => 'Logbook Mahasiswa',
                'icon' => 'ti-book',
                'submenu' => [
                    [
                        'name' => 'Magang Fakultas',
                        'route' => 'logbook_magang.fakultas',
                        'permission' => 'logbook_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'logbook_magang.mandiri',
                        'permission' => 'logbook_magang_mandiri.view'
                    ],
                ]
            ],
            [
                'name' => 'Kelola Semua Pengguna',
                'route' => 'kelola_semua_pengguna',
                'icon' => 'ti-users',
                'permission' => 'kelola_semua_pengguna.view'
            ],
            [
                'name' => 'Kelola Pengguna',
                'route' => 'kelola_pengguna',
                'icon' => 'ti-users',
                'permission' => 'kelola_pengguna.view'
            ],
            [
                'name' => 'Role',
                'route' => 'roles',
                'icon' => 'ti-user   ',
                'permission' => 'roles.view'
            ],
            [
                'name' => 'Master Data',
                'icon' => 'ti-database',
                'submenu' => [
                    [
                        'name' => 'Universitas',
                        'route' => 'universitas',
                        'permission' => 'universitas.view'
                    ],
                    [
                        'name' => 'Fakultas',
                        'route' => 'fakultas',
                        'permission' => 'fakultas.view'
                    ],
                    [
                        'name' => 'Program Studi',
                        'route' => 'prodi',
                        'permission' => 'program_studi.view'
                    ],
                    [
                        'name' => 'Tahun Akademik',
                        'route' => 'thn-akademik',
                        'permission' => 'tahun_akademik.view'
                    ],
                    [
                        'name' => 'Jenis Magang',
                        'route' => 'jenismagang',
                        'permission' => 'jenis_magang.view'
                    ],
                    [
                        'name' => 'Dosen',
                        'route' => 'dosen',
                        'permission' => 'dosen.view'
                    ],
                    [
                        'name' => 'Mahasiswa',
                        'route' => 'mahasiswa',
                        'permission' => 'mahasiswa.view'
                    ],
                    [
                        'name' => 'Nilai Mutu',
                        'route' => 'nilai-mutu',
                        'permission' => 'nilai_mutu.view'
                    ],
                    [
                        'name'=> 'Nilai Akhir',
                        'route'=>'nilai_akhir',
                        'permission'=> 'nilai_akhir.view'
                    ],
                    [
                        'name' => 'Komponen Penilaian',
                        'route' => 'komponen-penilaian',
                        'permission' => 'komponen_penilaian.view'
                    ],
                    [
                        'name' => 'Dokumen Persyaratan',
                        'route' => 'doc-syarat',
                        'permission' => 'dokumen_syarat.view'
                    ],
                    [
                        'name' => 'Pembimbing Lapangan Mandiri',
                        'route' => 'pembimbing-lapangan-mandiri',
                        'permission' => 'pembimbing_lapangan_mandiri.view'
                    ],
                    [
                        'name' => 'Wilayah',
                        'route' => 'wilayah',
                        'permission' => 'wilayah.view'
                    ]
                ]
            ],
            // mitra
            [
                'type' => 'menu-header',
                'name' => 'Mitra',
                'role' => 'Mitra'
            ],
            [
                'name' => 'Dashboard',
                'route' => 'dashboard_company',
                'icon' => 'ti-device-desktop-analytics',
                'permission' => 'dashboard.dashboard_mitra'
            ],
            [
                'name' => 'Lowongan Magang',
                'icon' => 'ti-briefcase',
                'submenu' => [
                    [
                        'name' => 'Informasi Lowongan',
                        'route' => 'informasi_lowongan',
                        'permission' => 'informasi_lowongan_mitra.view'
                    ],
                    [
                        'name' => 'Kelola Lowongan',
                        'route' => 'kelola_lowongan',
                        'permission' => 'kelola_lowongan_mitra.view'
                    ],
                ]
            ],
            [
                'name' => 'Anggota Tim',
                'route' => 'pegawaiindustri',
                'icon' => 'ti-users',
                'permission' => 'anggota_tim.view'
            ],
            [
                'name' => 'Proses Seleksi',
                'route' => 'jadwal_seleksi',
                'icon' => 'ti-clock',
                'permission' => 'jadwal_seleksi_mitra.view'
            ],
            [
                'name' => 'Assign Pembimbing',
                'route' => 'assign_pembimbing',
                'icon' => 'ti-clipboard-list',
                'permission' => 'assign_pembimbing.view'
            ],
            [
                'name' => 'Template Email',
                'route' => 'template_email',
                'icon' => 'ti-mail',
                'permission' => 'template_email.view'
            ],
            //pemb lapangan
            [
                'type' => 'menu-header',
                'name' => 'Pembimbing Lapangan',
                'role' => 'Pembimbing Lapangan'
            ],
            [
                'name' => 'Kelola Mahasiswa',
                'route' => 'kelola_magang_pemb_lapangan',
                'icon' => 'ti-users',
                'permission' => 'kelola_magang_pemb_lapangan.view'
            ],
            [
                'name' => 'Profile Perusahaan',
                'route' => 'profile_company',
                'icon' => 'ti-building',
                'permission' => 'profile_perusahaan.view'
            ],
            //kaprodi
            [
                'type' => 'menu-header',
                'name' => 'Kaprodi',
                'role' => 'Kaprodi'
            ],
            [
                'name' => 'Approval Mahasiswa Kaprodi',
                'route' => 'approval_mahasiswa_kaprodi',
                'icon' => 'ti-briefcase',
                'permission' => 'approval_mhs_kaprodi.view'
            ],
            [
                'name' => 'Data Mahasiswa Magang',
                'route' => 'mahasiswa_magang_kaprodi',
                'icon' => 'ti-file-analytics',
                'permission' => 'data_mahasiswa_magang_kaprodi.view'
            ],
            //dosen
            [
                'type' => 'menu-header',
                'name' => 'Dosen',
                'role' => 'Dosen'
            ],
            [
                'name' => 'Approval Mahasiswa',
                'route' => 'approval_mahasiswa',
                'icon' => 'ti-briefcase',
                'permission' => 'approval_mhs_doswal.view'
            ],
            [
                'name' => 'Data Mahasiswa Magang',
                'route' => 'mahasiswa_magang_dosen',
                'icon' => 'ti-file-analytics',
                'permission' => 'data_mahasiswa_magang_dosen.view'
            ],
            [
                'type' => 'menu-header',
                'name' => 'Pembimbing Akademik',
                'role' => ['Kaprodi', 'Dosen']
            ],
            [
                'name' => 'Kelola Mahasiswa',
                'route' => 'kelola_mhs_pemb_akademik',
                'icon' => 'ti-users',
                'permission' => 'kelola_mhs_pemb_akademik.view'
            ]
        ];
    }
}