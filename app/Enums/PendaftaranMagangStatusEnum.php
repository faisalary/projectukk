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
    const SCREENING = 'screening';
    const SELEKSI_TAHAP_1 = 'seleksi_tahap_1';
    const SELEKSI_TAHAP_2 = 'seleksi_tahap_2';
    const SELEKSI_TAHAP_3 = 'seleksi_tahap_3';
    const PENAWARAN = 'penawaran';
    const APPROVED_BY_COMPANY = 'approved_by_company';
    const REJECTED_BY_COMPANY = 'rejected_by_company';
    const APPROVED_BY_MAHASISWA = 'approved_by_mahasiswa';
    const REJECTED_BY_MAHASISWA = 'rejected_by_mahasiswa';
}
