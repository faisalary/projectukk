<?php

namespace App\Enums;

class TemplateEmailListProsesEnum
{
    use EnumTrait;

    const LOLOS_SELEKSI = 'lolos_seleksi';
    const PENJADWALAN_SELEKSI = 'penjadwalan_seleksi';
    const TIDAK_LOLOS_SELEKSI = 'tidak_lolos_seleksi';

    public static function getWithLabel($status = null)
    {
        $data = [
            self::LOLOS_SELEKSI => ['title' => 'Lulus Seleksi'],
            self::PENJADWALAN_SELEKSI => ['title' => 'Penjadwalan Seleksi'],
            self::TIDAK_LOLOS_SELEKSI => ['title' => 'Tidak Lulus Seleksi']
        ];

        if ($status != null) return $data[$status];

        return $data;
    }
}