<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataMahasiswaMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexFakultas()
    {
        return view('admin_kandidat.magang_fakultas');
    }

    public function indexMandiri()
    {
        return view('admin_kandidat.magang_mandiri');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
