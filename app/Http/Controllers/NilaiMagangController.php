<?php

namespace App\Http\Controllers;

use App\Models\ConfigNilaiAkhir;
use App\Models\MhsMagang;
use App\Models\NilaiPembAkademik;
use App\Models\NilaiPemblap;
use Illuminate\Http\Request;

class NilaiMagangController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        $data['mhs_magang'] = MhsMagang::select(
            'mhs_magang.id_mhsmagang', 'mahasiswa.id_prodi', 'mhs_magang.nilai_adjust', 'mhs_magang.nilai_akhir_magang', 'mhs_magang.indeks_nilai_akhir', 'mhs_magang.alasan_adjust'
        )
        ->join('pendaftaran_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
        ->join('mahasiswa', 'pendaftaran_magang.nim', '=', 'mahasiswa.nim')
        ->where('pendaftaran_magang.nim', $mahasiswa->nim)->first();

        $data['nilai_pemb_lapangan'] = NilaiPemblap::where('id_mhsmagang', $data['mhs_magang']->id_mhsmagang)->get();
        $data['nilai_pemb_akademik'] = NilaiPembAkademik::where('id_mhsmagang', $data['mhs_magang']->id_mhsmagang)->get();
        $data['config_nilai_akhir'] = ConfigNilaiAkhir::where('id_prodi', $data['mhs_magang']->id_prodi)->first();

        return view('kegiatan_saya.nilai_magang.nilai', $data);
    }
}