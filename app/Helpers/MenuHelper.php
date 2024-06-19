<?php 

namespace App\Helpers;

class MenuHelper
{

    public static function getInstance()
    {
        $data = self::getMenu();
        $result = self::menuMaker($data);
        return $result;
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
                'route' => 'data_magang',
                'icon' => 'ti-file-analytics',
                'permission' => 'data_magang.view'
            ],
            [
                'name' => 'Jadwal Seleksi',
                'route' => 'jadwal_seleksi',
                'icon' => 'ti-clock',
                'permission' => 'jadwal_seleksi_lkm.view'
            ],
            [
                'name' => 'Berkas Akhir Magang',
                'icon' => 'ti-folder',
                'submenu' => [
                    [
                        'name' => 'Magang Fakultas',
                        'route' => 'berkas_akhir_magang_fakultas.index',
                        'permission' => 'berkas_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'berkas_akhir_magang_mandiri.index',
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
                        'route' => 'nilai-magang-fakultas.index',
                        'permission' => 'nilai_mahasiswa_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'nilai-magang-mandiri.index',
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
                        'route' => 'logbook-magang-fakultas.index',
                        'permission' => 'logbook_magang_fakultas.view'
                    ],
                    [
                        'name' => 'Magang Mandiri',
                        'route' => 'logbook-magang-mandiri.index',
                        'permission' => 'logbook_magang_mandiri.view'
                    ],
                ]
            ],
            [
                'name' => 'Kelola Pengguna',
                'route' => 'kelola-pengguna.index',
                'icon' => 'ti-users',
                'permission' => 'kelola_pengguna.view'
            ],
            [
                'name' => 'Role',
                'route' => 'kelola-pengguna.index',
                'icon' => 'ti-user   ',
                'permission' => 'kelola_pengguna.view'
            ],
        ];
    }
}