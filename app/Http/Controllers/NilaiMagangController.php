<?php

namespace App\Http\Controllers;

use App\Models\ConfigNilaiAkhir;
use App\Models\KomponenNilai;
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
            'mhs_magang.id_mhsmagang', 'mahasiswa.id_prodi', 'mhs_magang.nilai_adjust', 'mhs_magang.nilai_akhir_magang', 'mhs_magang.indeks_nilai_akhir', 'mhs_magang.alasan_adjust',
            'mhs_magang.jenis_magang', 'dosen.namadosen', 'pegawai_industri.namapeg'
        )
        ->join('pendaftaran_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran')
        ->join('mahasiswa', 'pendaftaran_magang.nim', '=', 'mahasiswa.nim')
        ->leftJoin('dosen', 'dosen.nip', '=', 'mhs_magang.nip')
        ->leftJoin('pegawai_industri', 'pegawai_industri.id_peg_industri', '=', 'mhs_magang.id_peg_industri')
        ->where('pendaftaran_magang.nim', $mahasiswa->nim)->first();

        if (!$data['mhs_magang']) return abort(403);

        $komponenNilai = KomponenNilai::where('id_jenismagang', $data['mhs_magang']->jenis_magang)->get();

        $data['nilai_pemb_lapangan'] = NilaiPemblap::where('id_mhsmagang', $data['mhs_magang']->id_mhsmagang)->get();
        $data['dos_pemb_lapangan'] = $data['nilai_pemb_lapangan']->first()?->oleh;
        if (count($data['nilai_pemb_lapangan']) == 0) {
            $data['nilai_pemb_lapangan'] = $komponenNilai->where('scored_by', '2');
            $data['dos_pemb_lapangan'] = $data['mhs_magang']->namadosen ?? 'Not Yet Set';
        }

        $data['nilai_pemb_akademik'] = NilaiPembAkademik::where('id_mhsmagang', $data['mhs_magang']->id_mhsmagang)->get();
        $data['dos_pemb_akademik'] = $data['nilai_pemb_akademik']->first()?->oleh;
        if (count($data['nilai_pemb_akademik']) == 0) {
            $data['nilai_pemb_akademik'] = $komponenNilai->where('scored_by', '1');
            $data['dos_pemb_akademik'] = $data['mhs_magang']->namadosen ?? 'Not Yet Set';
        }

        $data['config_nilai_akhir'] = ConfigNilaiAkhir::where('id_prodi', $data['mhs_magang']->id_prodi)->first();

        return view('kegiatan_saya.nilai_magang.nilai', $data);
    }
}