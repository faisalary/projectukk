<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiAkhirController extends Controller
{
    public function index(){
        return view('masters.nilai_akhir.index');
    }
}
