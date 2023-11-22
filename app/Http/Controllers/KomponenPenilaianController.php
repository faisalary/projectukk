<?php

namespace App\Http\Controllers;

use App\Models\KomponenNilai;
use App\Http\Requests\KomponenNilaiRequest;
use App\Models\JenisMagang;
use Exception;
use Yajra\DataTables\DataTables;

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

    public function store(KomponenNilaiRequest $request)
    {
        // dd($request);
        try {
            foreach ($request->halo1 as $d) {
                KomponenNilai::create([
                    'id_jenismagang' => $request->jenismagang,
                    'namakomponen' => $d['namakomponen'],
                    'tipe' => '1',
                    'bobot' => str_replace('%', '', $d['bobot']),
                    'scoredby' => $d['scoredby'],
                    'status' => true,

                ]);
            }

            return response()->json([
                'error' => false,
                'message' => 'Komponen Nilai successfully Add!',
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

    public function show()
    {
        $penilaian = KomponenNilai::with("jenismagang")->orderby('id_jenismagang', 'asc')->get();
        // $prev = null;
        // $no = 0;
        // dd($penilaian);
        return DataTables::of($penilaian)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_jenismagang}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-url='komponen-penilaian/status' data-id='{$row->id_kompnilai}'  class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></a>";

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

            return response()->json([
                'error' => false,
                'message' => 'Status successfully Updated!',
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penilaian = KomponenNilai::where('id_jenismagang', $id)->first();
        return $penilaian;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KomponenNilai $request, string $id)
    {
        try {
            // $validated = $request->validated();

            $penilaian = KomponenNilai::where('id_kompnilai', $id)->first();

            $penilaian->namakomponen = $request->halo1[0]->namakomponen;
            $penilaian->bobot = str_replace('%', '', $request->halo1[0]->bobot);
            $penilaian->scoredby = $request->halo1[0]->scoredby;
            $penilaian->save();

            return response()->json([
                'error' => false,
                'message' => 'Komponen Nilai successfully Updated!',
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
}
