<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataMahasiswaMagangKaprodiController extends Controller
{
    public function index() {
        return view('data_mahasiswa_magang.index');
    }
}
