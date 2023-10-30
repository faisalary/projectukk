<?php

namespace App\Http\Controllers;

use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $univ = Universitas::all();
        return view('masters.universitas.index', compact('univ'));
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
        $request->validate(
            [
                'namauniv' => ['required', 'string', 'max:255', 'unique:universitas'],
                'jalan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'telp' => ['required', 'string', 'max:15'],

            ],
            [
                'namauniv.unique' => 'A University with the name already exist'
            ]
        );

        $univ = Universitas::create([
            'namauniv' => $request->namauniv,
            'jalan' => $request->jalan,
            'kota' => $request->kota,
            'telp' => $request->telp,

        ]);

        return response()->json([
            'error' => false,
            'message' => 'University Created!',
            'modal' => '#modalTambahUniversitas',
            'table' => '#table-master-univ'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $univ = Universitas::orderBy('namauniv', 'asc')->get();

        return DataTables::of($univ)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
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

                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas-{$row->id_univ}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = status($(this)) data-status='{$row->status}' data-id='{$row->id_univ}'  class='btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     Universitas::find($id)->update(['status' => $request->status]);

    //     return response()->json('Status updated');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $univ = Universitas::where('id_univ', $id)->first();
        return $univ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $univ = Universitas::where('id_univ', $id)->first();

            $univ->namauniv = $request->namauniv;
            $univ->jalan = $request->jalan;
            $univ->kota = $request->kota;
            $univ->telp = $request->telp;
            $univ->save();

            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Updated!',
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
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $univ = Universitas::where('id_univ', $id)->first();
            $univ->status = ($univ->status) ? false : true;
            $univ->save();

            return response()->json([
                'error' => false,
                'message' => 'Universitas successfully Deactived!',
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
}
