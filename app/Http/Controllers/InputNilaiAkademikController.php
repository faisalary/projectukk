<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;


class InputNilaiAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('kelola_mahasiswa.kelola_mahasiswa_akademik.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function input()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
    }


    
    public function show(Request $request)
    {
       
    }


    
    public function edit($id)
    {

    }

   
    public function update(Request $request, $id)
    {
        
    }
    

  
    public function status($id)
    {
        
    }
    
}