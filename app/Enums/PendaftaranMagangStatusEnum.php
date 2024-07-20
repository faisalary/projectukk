<?php 

namespace App\Enums;

abstract class PendaftaranMagangStatusEnum
{
    use EnumTrait;

    const PENDING = 'pending';
    const APPROVED_BY_DOSWAL = 'approved_by_doswal';
    const REJECTED_BY_DOSWAL = 'rejected_by_doswal';
    const APPROVED_BY_KAPRODI = 'approved_by_kaprodi';
    const REJECTED_BY_KAPRODI = 'rejected_by_kaprodi';
    const SELEKSI_TAHAP_1 = 'seleksi_tahap_1';
    const APRROVED_SELEKSI_TAHAP_1 = 'approved_seleksi_tahap_1';
    const REJECTED_SELEKSI_TAHAP_1 = 'rejected_seleksi_tahap_1';
    const APRROVED_SELEKSI_TAHAP_2 = 'approved_seleksi_tahap_2';
    const REJECTED_SELEKSI_TAHAP_2 = 'rejected_seleksi_tahap_2';
    const APRROVED_SELEKSI_TAHAP_3 = 'approved_seleksi_tahap_3';
    const REJECTED_SELEKSI_TAHAP_3 = 'rejected_seleksi_tahap_3';
    const APPROVED_PENAWARAN = 'approved_penawaran';
    const REJECTED_PENAWARAN = 'rejected_penawaran';

    public static function getWithLabel($status = null)
    {
        $data = [
            self::PENDING => ['title' => 'Menunggu Approval Dosen Wali', 'color' => 'warning'],
            self::APPROVED_BY_DOSWAL => ['title' => 'Menunggu Approval Kaprodi', 'color' => 'warning'],
            self::REJECTED_BY_DOSWAL => ['title' => 'Ditolak oleh Dosen Wali', 'color' => 'warning'],
            self::APPROVED_BY_KAPRODI => ['title' => 'Screening oleh Industri', 'color' => 'warning'],
            self::REJECTED_BY_KAPRODI => ['title' => 'Ditolak oleh Kaprodi', 'color' => 'warning'],
            self::SELEKSI_TAHAP_1 => ['title' => 'Seleksi Tahap 1', 'color' => 'info'],
            self::APRROVED_SELEKSI_TAHAP_1 => ['title' => 'Seleksi Tahap 2', 'color' => 'info'],
            self::REJECTED_SELEKSI_TAHAP_1 => ['title' => 'Ditolak di Seleksi Tahap 1', 'color' => 'danger'],
            self::APRROVED_SELEKSI_TAHAP_2 => ['title' => 'Seleksi Tahap 3', 'color' => 'info'],
            self::REJECTED_SELEKSI_TAHAP_2 => ['title' => 'Ditolak di Seleksi Tahap 2', 'color' => 'danger'],
            self::APRROVED_SELEKSI_TAHAP_3 => ['title' => 'Penawaran', 'color' => 'info'],
            self::REJECTED_SELEKSI_TAHAP_3 => ['title' => 'Ditolak di Seleksi Tahap 3', 'color' => 'danger'],
            self::APPROVED_PENAWARAN => ['title' => 'Penawaran diterima', 'color' => 'success'],
            self::REJECTED_PENAWARAN => ['title' => 'Penawaran ditolak', 'color' => 'danger'],
        ];

        if ($status != null) return $data[$status];

        return $data;
    }
}
