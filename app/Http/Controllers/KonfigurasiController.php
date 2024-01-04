<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KonfigurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permissions:only.lkm.mitra|only.lkm|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permissions:role-create', ['only' => ['create','store']]);
         $this->middleware('permissions:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permissions:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('konfigurasi.konfigurasi');
    }
    public function store(Request $request)
    {
        
    }
}
