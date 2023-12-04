<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalSeleksiController extends Controller
{
    public function index() {
        return view('company.jadwal_seleksi.index');
        
    }
}
