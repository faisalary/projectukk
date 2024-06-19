<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiMahasiswaController extends Controller
{
    public function viewMagangFakultas()
    {
        return view('nilai_mahasiswa.magang_fakultas.index');
    }

    public function viewMagangMandiri()
    {
        return view('nilai_mahasiswa.magang_mandiri.index');
    }

    public function detailMagangFakultas()
    {
        return view('nilai_mahasiswa.magang_fakultas.nilai');
    }

    public function detailMagangMandiri()
    {
        return view('nilai_mahasiswa.magang_mandiri.nilai');
    }
}
