<?php

namespace App\Http\Controllers;

use App\Models\KomponenNilai;
use App\Http\Requests\KomponenNilaiRequest;
use App\Models\JenisMagang;
use Exception;
use Illuminate\Http\Request;

class KomponenPenilaianController extends Controller
{
    public function index()
    {
        $penilaian = KomponenNilai::all();
        $id_jenismagang = JenisMagang::all();
        return view('masters.komponen_penilaian.index', compact('id_jenismagang'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(KomponenNilaiRequest $request)
    {
        try{
            KomponenNilai::create([
                'id_kompnilai' => $request->kompnilai,
                'id_jenismagang' => $request->jenismagang,
                'namakomponen' => $request->namakomponen,
                'tipe'=>$request->tipe,
                'bobot'=>$request->bobot,
                'scoredby'=>$request->scoredby,
                'status'=> true,
                'total_bobot'=>$request->total_bobot,

            ]); 

            return response()->json([
                'error' => false,
                'message' => 'bagus',
                'modal' => '#modal-komponen-nilai',
                'table' => '#table-master-komponen'
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
    public function show($id_jenismagang)
    {
        $penilaian = KomponenNilai::query();
        if($id_jenismagang !== 'all'){
            $penilaian = $penilaian->where('id_jenismagang',$id_jenismagang );

        }
        $penilaian->with('id');
    }
    

}


