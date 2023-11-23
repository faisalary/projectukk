<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FakultasRequest;
use App\Models\Dosen;
use App\Models\Universitas;
use App\Models\Fakultas;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class FakultasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:only.lkm', ['only' => ['index']]);
        $this->middleware('permission:create.fakultas', ['only' => ['store']]);
        $this->middleware('permission:edit.fakultas', ['only' => ['edit']]);
        $this->middleware('permission:update.fakultas', ['only' => ['update']]);
        $this->middleware('permission:status.fakultas', ['only' => ['status']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universitas = Universitas::all(); // Gantilah dengan model dan metode sesuai dengan struktur basis data Anda
        $fakultas = Fakultas::all();
        return view('masters.fakultas.index', compact('fakultas','universitas'));
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
    public function store(FakultasRequest $request)
    {
        try {
            
            $fakultas = Fakultas::create([

                'id_univ' => $request->namauniv,
                'namafakultas' => $request->namafakultas,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Fakultas successfully Created!',
                'modal' => '#modal-fakultas',
                'table' => '#table-master-fakultas'
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
    public function show($id_univ)
    {
        $fakultas = Fakultas::query();
        if ($id_univ !== 'all'){
            $fakultas = $fakultas->where('id_univ',$id_univ);
        }
        $fakultas->with('univ')->orderBy('id_fakultas', 'asc')->get();

        return DataTables::of($fakultas)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_fakultas}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_fakultas}' data-url='fakultas/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $fakultas = Fakultas::where('id_fakultas', $id)->first();
        return $fakultas;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fakultas = Fakultas::where('id_fakultas', $id)->first();

            $fakultas->id_univ = $request->namauniv;
            $fakultas->namafakultas = $request->namafakultas;
            $fakultas->save();

            return response()->json([
                'error' => false,
                'message' => 'Fakultas sudah diupdate!',
                'modal' => '#modal-fakultas',
                'table' => '#table-master-fakultas'
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
    public function status($id)
    {
        try {
            $fakultas = Fakultas::where('id_fakultas', $id)->first();
            $fakultas->status = ($fakultas->status) ? false : true;
            $fakultas->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Fakultas successfully Updated!',
                'modal' => '#modal-fakultas',
                'table' => '#table-master-fakultas'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}