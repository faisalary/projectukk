<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerkasAkhirMagangController extends Controller
{
    public function viewMagangFakultas()
    {
        return view('berkas_akhir_magang.magang_fakultas.index');
    }

    public function viewMagangMandiri()
    {
        return view('berkas_akhir_magang.magang_mandiri.index');
    }
}
