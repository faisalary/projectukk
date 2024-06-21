<?php

namespace App\Http\Controllers;

use App\Models\KomponenNilai;
use App\Http\Requests\KomponenNilaiRequest;
use App\Models\JenisMagang;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class KomponenPenilaianController extends Controller
{
    public function index()
    {
        $penilaian = KomponenNilai::all();
        $id_jenismagang = JenisMagang::all();
        return view('masters.komponen_penilaian.index', compact('id_jenismagang', 'penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            foreach ($request->komponen as $d) {
                KomponenNilai::create([
                    'id_jenismagang' => $request->id_jenismagang,
                    'bobot' => $request->bobot,
                    'aspek_penilaian' =>$d['aspek_penilaian'],
                    'deskripsi_penilaian' => $d['deskripsi_penilaian'],
                    'scored_by' => $d['scored_by'],
                    'nilai_max' => $d['nilai_max'],
                    'status' => true,

                ]);
                
                
            if( $d['scored_by'] == 1){
                $table = '#table-akademik';
            } else{
                $table = '#table-lapangan';   
            }
            }
        

            return response()->json([
                'error' => false,
                'message' => 'Komponen Nilai successfully Add!',
                'modal' => '#modal-komponen-nilai',
                'table' => $table
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

    public function show($scored_by)
    {
        $penilaian = KomponenNilai::with("jenismagang")->where("scored_by",$scored_by)->orderBy('id_jenismagang', "asc")->get();
        return DataTables::of($penilaian)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $url = url('master/komponen-nilai/status/' . $row->id_kompnilai);
                $btn = "<a data-bs-toggle='modal-komponen-nilai' data-id='{$row->id_kompnilai}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])

            ->make(true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $nilai = KomponenNilai::where('id_kompnilai', $id)->first();
            $nilai->status = ($nilai->status) ? false : true;
            $nilai->save();

            if($nilai->scored_by == 1){
                $table = '#table-akademik';
            } else{
                $table = '#table-lapangan';   
            }

            return response()->json([
                'error' => false,
                'message' => 'Status successfully Updated!',
                'table' => $table
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penilaian = KomponenNilai::where('id_kompnilai', $id)->first();
        return $penilaian;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // $validated = $request->validated();

            foreach ($request->komponen as $d) {
                KomponenNilai::where('id_kompnilai',$id)->first()->update([
                    'id_jenismagang' => $request->id_jenismagang,
                    'bobot' => $request->bobot,
                    'aspek_penilaian' =>$d['aspek_penilaian'],
                    'deskripsi_penilaian' => $d['deskripsi_penilaian'],
                    'scored_by' => $d['scored_by'],
                    'nilai_max' => $d['nilai_max'],

                ]);
            }
            
            $cek_scored = KomponenNilai::where('id_kompnilai',$id)->first()->scored_by;
            if($cek_scored == 1){
                $table = '#table-akademik';
            } else{
                $table = '#table-lapangan';   
            }
            return response()->json([
                'error' => false,
                'message' => 'Komponen Nilai successfully Updated!',
                'modal' => '#modal-komponen-nilai',
                'table' => $table
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}