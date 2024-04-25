<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\LowonganMagang;
use Illuminate\Http\Request;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowongan = LowonganMagang::with('industri')->get();
        return view('perusahaan.lowongan', compact('lowongan'));
    }
}
