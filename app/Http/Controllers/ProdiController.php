<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdiRequest;
use Exception;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Fakultas;
use App\Models\Universitas;
use Illuminate\Routing\Route;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all();
        $universitas = Universitas::all();
        $prodi = ProgramStudi::all();
        return view('masters.prodi.index', compact('prodi', 'fakultas', 'universitas'));
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
    public function store(ProdiRequest $request)
    {
        $request->validate(
            [
                'pilihfakultas' => ['required'],
                'pilihuniversitas' => ['required'],
                'namaprodi' => ['required', 'string', 'max:255'],
            ],
            [
                'pilihfakultas.required' => 'The Fakultas is required!'
            ]
        );

        $prodi = ProgramStudi::create([
            'id_fakultas' => $request->pilihfakultas,
            'id_univ' => $request->pilihuniversitas,
            'namaprodi' => $request->namaprodi,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Data Created!',
            'modal' => '#modalTambahProdi',
            'table' => '#table-master-prodi'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $prodi = ProgramStudi::query();
        if ($request->fakultas != null) {
            $prodi->where("id_fakultas", $request->fakultas);
        } else if ($request->univ != null) {
            $prodi->where("id_univ", $request->univ);
        } else if ($request->prodi != null) {
            $prodi->where("id_prodi", $request->prodi);
        }

        $prodi = $prodi->with("univ", "fakultas")->orderBy('id_prodi', "asc")->get();

        return DataTables::of($prodi)
            ->addIndexColumn()
            ->editColumn('status', function ($prodi) {
                if ($prodi->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($prodi) {
                $icon = ($prodi->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($prodi->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$prodi->id_prodi}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$prodi->status}' data-id='{$prodi->id_prodi}' data-url='prodi/status' class='update-status btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['status', 'action'])

            // ->json();
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prodi = ProgramStudi::where('id_prodi', $id)->first();
        return $prodi;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdiRequest $request, $id)
    {
        try {
            $prodi = ProgramStudi::where('id_prodi', $id)->first();

            $prodi->id_univ = $request->pilihuniversitas;
            $prodi->id_fakultas = $request->pilihfakultas;
            $prodi->namaprodi = $request->namaprodi;
            $prodi->save();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modalTambahProdi',
                'table' => '#table-master-prodi'
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
            $prodi = ProgramStudi::where('id_prodi', $id)->first();
            $prodi->status = ($prodi->status) ? false : true;
            $prodi->save();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Deactived!',
                'modal' => '#modalTambahProdi',
                'table' => '#table-master-prodi'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function list_fakultas($id_univ)
    {
        $fakultas = Fakultas::where("id_univ", $id_univ)->get();
        $select = array(
            0 => ["id" => '', 'text' => 'pilih']
        );

        foreach ($fakultas as $item) {
            $select[] = ["id" => $item->id_fakultas, "text" => $item->namafakultas];
        }
        return response()->json([
            'error' => false,
            'data' => $select
        ]);
    }

    public function list_prodi($id_fakultas)
    {
        $prodi = ProgramStudi::where("id_fakultas", $id_fakultas)->get();
        $select = array(
            0 => ["id" => '', 'text' => 'pilih']
        );

        foreach ($prodi as $item) {
            $select[] = ["id" => $item->id_prodi, "text" => $item->namaprodi];
        }
        return response()->json([
            'error' => false,
            'data' => $select,
        ]);
    }
}