<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\MataKuliah;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->middleware('permission:igracias.view');
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            MataKuliah::create([
                'kode_mk' => $request->kode_mk,                               
                'namamk' => $request->namamk,
                'id_univ' => $request->id_univ,
                'id_fakultas' => $request->id_fakultas,
                'id_prodi' => $request->id_prodi,
                'sks' => $request->sks,               
                'status' => true,
            ]);

            return Response::success(null, 'Mata Kuliah successfully Created!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $mata_kuliah = MataKuliah::select('mata_kuliah.*', 'universitas.namauniv', 'fakultas.namafakultas', 'program_studi.namaprodi')
        ->leftJoin('universitas', 'universitas.id_univ', '=', 'mata_kuliah.id_univ')
        ->leftJoin('fakultas', 'fakultas.id_fakultas', '=', 'mata_kuliah.id_fakultas')
        ->leftJoin('program_studi', 'program_studi.id_prodi', '=', 'mata_kuliah.id_prodi');

        if ($request->id_prodi_filter != null) {
            $mata_kuliah->where("mata_kuliah.id_prodi", $request->id_prodi_filter);
        }

        $mata_kuliah = $mata_kuliah->with('univ', 'prodi', 'fakultas')->orderBy('kode_mk', "asc")->get();
        
        return DataTables::of($mata_kuliah)
            ->addIndexColumn()            
            ->editColumn('namamk', fn ($data) => '<div class="text-nowrap">' . $data->namamk . '</div>')
            ->editColumn('id_univ', function ($data) {
                $result = '<span class="fw-bolder text-nowrap">' .$data->namauniv. '</span><br>';
                $result .= '<span class="text-nowrap">' .$data->namafakultas. '</span><br>';
                $result .= '<small class="text-nowrap">(' .$data->namaprodi. ')</small>';

                return $result;
            })
            ->editColumn('sks', fn ($data) => '<div class="text-center">' . $data->sks . '</div>')
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-primary'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";

                $url = route('igracias.matakuliah.status', $row->kode_mk);
                $btn = "<div class='d-flex justfiy-content-center'><a data-bs-toggle='modal' data-id='{$row->kode_mk}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' data-function='afterUpdateStatus' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";

                return $btn;
            })
            ->rawColumns(['id_univ', 'namamk', 'sks', 'action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mata_kuliah = MataKuliah::where('kode_mk', $id)->first();
        if (!$mata_kuliah) return Response::error(null, 'Not Found', 404);

        return Response::success($mata_kuliah, 'Success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mata_kuliah = MataKuliah::where('kode_mk', $id)->first();

            $mata_kuliah->kode_mk = $request->kode_mk;
            $mata_kuliah->namamk = $request->namamk;
            $mata_kuliah->id_univ = $request->id_univ;
            $mata_kuliah->id_fakultas = $request->id_fakultas;
            $mata_kuliah->id_prodi = $request->id_prodi;           
            $mata_kuliah->sks = $request->sks;                             
            $mata_kuliah->save();

            return Response::success(null, 'Mata Kuliah sudah diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function status($id)
    {
        try {
            $mata_kuliah = MataKuliah::where('kode_mk', $id)->first();            
            $mata_kuliah->status = ($mata_kuliah->status) ? false : true;
            $mata_kuliah->save();

            return Response::success(null, 'Status Mata Kuliah successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }  
}
