<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfileMahasiswaController extends Controller
{
    public function index() { 
        return view('profile.informasi_pribadi');
    }

    public function store() {
        $mahasiswa = Mahasiswa::create([

        ]);
    }
}
