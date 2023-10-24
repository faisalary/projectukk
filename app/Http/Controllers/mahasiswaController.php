<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Universitas;
class MahasiswaController extends Controller
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
    public function store(Request $request)
    {
        $request->validate(
            [
                'nim' => ['required', 'max:11','unique:mahasiswa'],
                'angkatan' => ['required', 'integer'],
                'id_prodi' => ['required'],
                'id_univ' => ['required'],
                'id_fakultas' => ['required'],
                'namamhs' => ['required', 'string', 'max:255'],
                'alamatmhs' => ['required', 'string', 'max:255'],
                'emailmhs' => ['required', 'string', 'max:255'],
                'nohpmhs' => ['required', 'string', 'max:15'],
            ],
            [
                'nim.unique' => 'The NIM already exist'
            ]
        );

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'id_prodi' => $request->id_prodi,
            'id_univ' => $request->id_univ,
            'id_fakultas' => $request->id_fakultas,
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
        $mahasiswa = Mahasiswa::join('fakultas','fakultas.id_fakultas', 'mahasiswa.id_fakultas')
        ->join ('program_studi','program_studi.id_prodi', 'mahasiswa.id_prodi')
        ->join ('universitas','universitas.id_univ', 'mahasiswa.id_univ')
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