<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerkasAkhirMagangController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:berkas_magang_fakultas.view', ['only' => ['viewMagangFakultas']]);
        $this->middleware('permission:berkas_magang_mandiri.view', ['only' => ['viewMagangMandiri']]);
    }

    public function viewMagangFakultas()
    {
        return view('berkas_akhir_magang.magang_fakultas.index');
    }

    public function viewMagangMandiri()
    {
        return view('berkas_akhir_magang.magang_mandiri.index');
    }
}
