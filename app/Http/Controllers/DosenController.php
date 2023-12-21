<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use App\Models\Fakultas;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;


class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:only.lkm', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universitas = Universitas::all(); // Gantilah dengan model dan metode sesuai dengan struktur basis data Anda
        $prodi = ProgramStudi::all();
        $fakultas = Fakultas::all();
        $dosen = Dosen::all();
        return view('masters.dosen.index', compact('dosen', 'prodi', 'universitas', 'fakultas'));
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
    public function store(DosenRequest $request)
    {
        try {
            $request->validate(
                [
                    'namafakultas' => ['required'],
                    'namauniv' => ['required'],
                    'namaprodi' => ['required'],
                ],
                [
                    'namafakultas.required' => 'The Fakultas is required!'
                ]
            );
            $dosen = Dosen::create([
                'nip' => $request->nip,
                'id_univ' => $request->namauniv,
                'prodi.fakultas.id_fakultas' => $request->namafakultas,
                'id_prodi' => $request->namaprodi,
                'kode_dosen' => $request->kode_dosen,
                'namadosen' => $request->namadosen,
                'nohpdosen' => $request->nohpdosen,
                'emaildosen' => $request->emaildosen,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Dosen successfully Created!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
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
    public function show(Request $request)
    {
        // $dosen = Dosen::with('univ','prodi.fakultas')->orderBy('nip', 'asc')->get();
        $dosen = Dosen::query();
        if ($request->fakultas != null) {
            $dosen->where("id_fakultas", $request->fakultas);
        } else if ($request->univ != null) {
            $dosen->where("id_univ", $request->univ);
        }
        $dosen = $dosen->with("univ", "prodi.fakultas")->orderBy('nip', "asc")->get();

        return DataTables::of($dosen)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->nip}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->nip}' data-url='dosen/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $dosen = Dosen::where('nip', $id)->first();
        return $dosen;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->first();

            $dosen->nip = $request->nip;
            $dosen->id_univ = $request->namauniv;
            $dosen->id_prodi = $request->namafakultas;
            $dosen->id_prodi = $request->namaprodi;
            $dosen->kode_dosen = $request->kode_dosen;
            $dosen->namadosen = $request->namadosen;
            $dosen->nohpdosen = $request->nohpdosen;
            $dosen->emaildosen = $request->emaildosen;
            $dosen->save();

            return response()->json([
                'error' => false,
                'message' => 'Dosen sudah diupdate!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
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
            $dosen = Dosen::where('nip', $id)->first();
            $dosen->status = ($dosen->status) ? false : true;
            $dosen->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Dosen successfully Updated!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
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
    
    public function import (Request $request){
        $data = $request->file('import');
        $namafile = $data-> getClientOriginalName();
        $data->move('DosenData', $namafile);
        Excel::import(new DosenImport, \public_path('/DosenData/'.$namafile));
        return \redirect()->back();
    }
}