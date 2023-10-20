<?php

namespace App\Http\Controllers;

use App\Models\Universitas;
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
    public function store(Request $request)
    {
        $request->validate(
            [
                'namauniv' => ['required', 'string', 'max:255', 'unique:universitas'],
                'jalan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'telp' => ['required', 'string', 'max:15'],
                'status' => ['required', 'boolean', 'default:true'],
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
            'status' => $request->status,
        ]);

        return response()->json([
            'error' => false,
            'massage' => 'University Created!',
            'modal' => '#modalTambahUniversitas',
            'table' => '#table-master-univ'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $univ = DB::table('universitas')->select(
            'id_univ as id_univ',
            'namauniv as namauniv',
            'jalan as jalan',
            'kota as kota',
            'telp as telp',
            'status as status',
        )
            ->orderBy('namauniv', 'asc')
            ->get();

        return DataTables::of($univ)
            ->addIndexColumn()
            ->addColumn('action', function ($univ) {
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>";

                return $btn;
            })
            ->addColumn('action', function ($univ) {
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalEditUniversitas' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>";

                return $btn;
            })
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
