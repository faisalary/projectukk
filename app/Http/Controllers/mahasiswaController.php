<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use App\Models\User;
use App\Imports\MhsImport;
use Maatwebsite\Excel\Facades\Excel;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        $fakultas = Fakultas::all();
        $prodi = ProgramStudi::all();
        $universitas = Universitas::all();
        return view('masters.mahasiswa.index', compact('mahasiswa','fakultas','prodi','universitas'));
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
    public function store(MahasiswaRequest $request)
    {
        try {

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'id_prodi' => $request->namaprodi,
            'id_univ' => $request->namauniv,
            'id_fakultas' => $request->namafakultas,
            'namamhs' => $request->namamhs,
            'alamatmhs' => $request->alamatmhs,
            'emailmhs' => $request->emailmhs,
            'nohpmhs' => $request->nohpmhs, 
            
        ]);
       
        $admin = User::create([
            'name' => 'mahasiswa',
            'username' => $request->namamhs,
            'email' => $request->emailmhs,
            'password' => bcrypt('12345678'),            
            'isAdmin'=>2,
            'nim' => $mahasiswa->nim,
        ]);
        $admin->assignRole('user');
     


        return response()->json([
            'error' => false,
            'message' => 'Data Created!',
            'modal' => '#modal-mahasiswa',
            'table' => '#table-master-mahasiswa'
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
        $mahasiswa = Mahasiswa::query();
        if ($request->fakultas != null) {
            $mahasiswa->where("id_fakultas", $request->fakultas);
        } else if ($request->univ !=null) {
            $mahasiswa->where("id_univ", $request->univ);
        }
        $mahasiswa = $mahasiswa->with("univ", "prodi","fakultas")->orderBy('nim', "asc")->get();

        return DataTables::of($mahasiswa)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->nim}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->nim}' data-url='mahasiswa/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])

            ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();

            $mahasiswa->nim = $request->nim;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->id_prodi = $request->namaprodi;
            $mahasiswa->id_univ = $request->namauniv;
            $mahasiswa->id_fakultas = $request->namafakultas;
            $mahasiswa->namamhs = $request->namamhs;
            $mahasiswa->alamatmhs = $request->alamatmhs;
            $mahasiswa->emailmhs = $request->emailmhs;
            $mahasiswa->nohpmhs = $request->nohpmhs;
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Mahasiswa successfully Updated!',
                'modal' => '#modal-mahasiswa',
                'table' => '#table-master-mahasiswa'
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
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->status = ($mahasiswa->status) ? false : true;
            $mahasiswa->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Mahasiswa successfully Updated!',
                'modal' => '#modal-mahasiswa',
                'table' => '#table-master-mahasiswa'
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
        $data->move('MhsData', $namafile);
        Excel::import(new MhsImport, \public_path('/MhsData/'.$namafile));
        return \redirect()->back();
    }
}