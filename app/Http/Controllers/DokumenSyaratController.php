<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\DocumentSyarat;

class DokumenSyaratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doc = DocumentSyarat::all();
        return view('masters.dokumen_persyaratan.index', compact('doc'));
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
        try {

            $doc = DocumentSyarat::create([
                'namauniv' => $request->namauniv,
                'jalan' => $request->jalan,
                'kota' => $request->kota,
                'telp' => $request->telp,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Created!',
                'modal' => '#modal-universitas',
                'table' => '#table-master-univ'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
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
