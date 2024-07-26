<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaMahasiswaPemAkademikController extends Controller
{
    public function index() {
        return view('kelola_mahasiswa/index');
    }
}
