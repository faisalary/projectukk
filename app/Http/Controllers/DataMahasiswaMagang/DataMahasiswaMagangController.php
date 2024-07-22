<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use App\Enums\PendaftaranMagangStatusEnum;

class DataMahasiswaMagangController extends Controller
{

    public function __construct()
    {
        // $this->pendaftaran_magang = null;
    }

    protected function getPendaftaranMagang($additional = null) {
        $this->pendaftaran_magang = PendaftaranMagang::join('mahasiswa', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->leftJoin('mhs_magang', 'pendaftaran_magang.id_pendaftaran', '=', 'mhs_magang.id_pendaftaran')
        ->leftJoin('pegawai_industri', 'mhs_magang.id_peg_industri', '=', 'pegawai_industri.id_peg_industri')
        ->leftJoin('dosen', 'mhs_magang.nip', '=', 'dosen.nip');

        if($additional != null) $this->pendaftaran_magang = $additional($this->pendaftaran_magang);

        return $this;
    }

    protected function getPendaftaranMagangDiterima() {
        $this->getPendaftaranMagang(function ($query) {
            return $query->whereIn('pendaftaran_magang.current_step', [
                PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL,
                PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI,
                PendaftaranMagangStatusEnum::SELEKSI_TAHAP_1,
                PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_1,
                PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_2,
                PendaftaranMagangStatusEnum::APRROVED_SELEKSI_TAHAP_3,
                PendaftaranMagangStatusEnum::APPROVED_PENAWARAN
            ]);
        });

        return $this;
    }

    protected function getPendaftaranMagangDitolak() {
        $this->getPendaftaranMagang(function ($query) {
            return $query->whereIn('pendaftaran_magang.current_step', [
                PendaftaranMagangStatusEnum::REJECTED_BY_DOSWAL,
                PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_1,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_2,
                PendaftaranMagangStatusEnum::REJECTED_SELEKSI_TAHAP_3,
                PendaftaranMagangStatusEnum::REJECTED_PENAWARAN
            ]);
        });

        return $this;
    }
 
}
