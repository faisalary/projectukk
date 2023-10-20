<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('masters.mahasiswa.index', compact('mahasiswa'));
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
        // $request->validate(
        //     [
        //         'nim' => ['required', 'integer','unique:nim'],
        //         'angkatan' => ['required', 'integer'],
        //         'id_prodi' => ['required', 'uuid'],
        //         'id_univ' => ['required', 'uuid'],
        //         'id_fakultas' => ['required', 'uuid'],
        //         'namamhs' => ['required', 'string', 'max:255'],
        //         'alamatmhs' => ['required', 'string', 'max:255'],
        //         'emailmhs' => ['required', 'string', 'max:255'],
        //         'nohpmhs' => ['required', 'string', 'max:15'],
        //         'kelas' => ['required', 'string', 'max:255'],
        //     ],
        //     [
        //         'nim.unique' => 'The NIM already exist'
        //     ]
        // );

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'id_prodi' => $request->prodi,
            'id_univ' => $request->univ,
            'id_fakultas' => $request->fakultas,
            'namamhs' => $request->namamhs,
            'alamatmhs' => $request->alamatmhs,
            'emailmhs' => $request->emailmhs,
            'nohpmhs' => $request->nohpmhs, 
        ]);

        return response()->json([
            'error' => false,
            'massage' => 'Data Created!',
            'modal' => '#modalTambahMahasiswa',
            'table' => '#table-master-mahasiswa'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $mahasiswa = DB::table('mahasiswa')->select(
            'nim as nim',
            'angkatan as angkatan',
            'id_prodi as prodi',
            'id_univ as univ',
            'id_fakultas as fakultas',
            'namamhs as namamhs',
            'alamatmhs as alamatmhs',
            'emailmhs as emailmhs',
            'nohpmhs as nohpmhs', 
        )
            ->orderBy('nim', 'asc')
            ->get();

        return DataTables::of($mahasiswa)
            ->addIndexColumn()
            ->addColumn('action', function ($mahasiswa) {
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalEditMahasiswa' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>";

                return $btn;
            })
            ->addColumn('action', function ($mahasiswa) {
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalEditMahasiswa' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = deactive($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-circle-x'></i></a>";

                return $btn;
            })
            ->toJson();
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