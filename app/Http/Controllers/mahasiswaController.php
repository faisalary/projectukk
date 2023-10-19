<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use illuminate\View\View;
use Illuminate\Http\Request;
use App\HTTP\Controllers\Controller;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters.mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Mahasiswa::created([
            'mahasiswa' => $data['namamhs'],
            'mahasiswa' => $data['emailmhs'],
            'mahasiswa' => $data['nohpmhs'],
            'mahasiswa' => $data['alamatmhs'],
            'mahasiswa' => $data['kelas']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}