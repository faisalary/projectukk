<?php

namespace App\Http\Controllers\DataMahasiswaMagang;

class DataMahasiswaMagangKaprodiController extends DataMahasiswaMagangController
{
    public function index() {
        return view('data_mahasiswa_magang.index');
    }
}
