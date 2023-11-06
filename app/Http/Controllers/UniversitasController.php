<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversitasRequest;
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
        $universities = Universitas::all();
        return view('masters.universitas.index', compact('universities'));
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
    public function store(UniversitasRequest $request)
    {
        try {

            $univ = Universitas::create([
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
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_univ}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_univ}' data-url='universitas/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $univ = Universitas::where('id_univ', $id)->first();
        return $univ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversitasRequest $request, string $id)
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
                'message' => 'Status Universitas successfully Updated!',
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
