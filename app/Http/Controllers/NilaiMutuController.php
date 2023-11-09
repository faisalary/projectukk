<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\NilaiMutu;
use Illuminate\Http\Request;
use App\Http\Requests\NilaiMutuRequest;
use Yajra\DataTables\Facades\DataTables;

class NilaiMutuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = NilaiMutu::all();
        return view('masters.nilai_mutu.index', compact('nilai'));
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
    public function store(NilaiMutuRequest $request)
    {
        try {

            $nilai = NilaiMutu::create([
                'nilaimin' => $request->nilaimin,
                'nilaimax' => $request->nilaimax,
                'nilaimutu' => $request->nilaimutu,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Nilai Mutu successfully Created!',
                'modal' => '#modal-nilai-mutu',
                'table' => '#table-master-nilai-mutu'
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
        $nilai = NilaiMutu::orderBy('nilaimin', 'desc')->get();

        return DataTables::of($nilai)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_nilai}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_nilai}' data-url='nilai-mutu/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nilai = NilaiMutu::where('id_nilai', $id)->first();
        return $nilai;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NilaiMutuRequest $request, string $id)
    {
        try {
            // $validated = $request->validated();

            $nilai = NilaiMutu::where('id_nilai', $id)->first();

            $nilai->nilaimin = $request->nilaimin;
            $nilai->nilaimax = $request->nilaimax;
            $nilai->nilaimutu = $request->nilaimutu;
            $nilai->save();

            return response()->json([
                'error' => false,
                'message' => 'Nilai Mutu successfully Updated!',
                'modal' => '#modal-nilai-mutu',
                'table' => '#table-master-nilai-mutu'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $nilai = NilaiMutu::where('id_nilai', $id)->first();
            $nilai->status = ($nilai->status) ? false : true;
            $nilai->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Nilai Mutu successfully Updated!',
                'modal' => '#modal-nilai-mutu',
                'table' => '#table-master-nilai-mutu'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
