<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Helpers\Response;
use App\Models\Universitas;
use App\Imports\DosenImport;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DosenRequest;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;


class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:dosen.view');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            if ($request->section == 'id_fakultas') {
                $data = Fakultas::select('namafakultas as name', 'id_fakultas as id')->where('id_univ', $request->selected)->get();
            }
            if ($request->section == 'id_prodi') {
                $data = ProgramStudi::select('namaprodi as name', 'id_prodi as id')->where('id_fakultas', $request->selected)->get();
            }

            return Response::success($data, 'Success');
        }

        $universitas = Universitas::all(); // Gantilah dengan model dan metode sesuai dengan struktur basis data Anda
        return view('masters.dosen.index', compact('universitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DosenRequest $request)
    {
        try {
            $dosen = Dosen::create([
                'nip' => $request->nip,
                'id_univ' => $request->id_univ,
                'id_fakultas' => $request->id_fakultas,
                'id_prodi' => $request->id_prodi,
                'kode_dosen' => $request->kode_dosen,
                'namadosen' => $request->namadosen,
                'nohpdosen' => $request->nohpdosen,
                'emaildosen' => $request->emaildosen,
                'status' => true,
            ]);

            return Response::success(null, 'Dosen successfully Created!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $dosen = Dosen::select('dosen.*', 'universitas.namauniv', 'fakultas.namafakultas', 'program_studi.namaprodi')
        ->join('universitas', 'universitas.id_univ', '=', 'dosen.id_univ')
        ->join('fakultas', 'fakultas.id_fakultas', '=', 'dosen.id_fakultas')
        ->join('program_studi', 'program_studi.id_prodi', '=', 'dosen.id_prodi');

        return DataTables::of($dosen->orderBy('nip', "asc")->get())
            ->addIndexColumn()
            ->editColumn('id_univ', function ($data) {
                $result = '<span class="fw-bolder text-nowrap">' .$data->namauniv. '</span><br>';
                $result .= '<span class="text-nowrap">' .$data->namafakultas. '</span><br>';
                $result .= '<small class="text-nowrap">(' .$data->namaprodi. ')</small>';

                return $result;
            })
            ->editColumn('namadosen', fn ($data) => '<div class="text-nowrap">' . $data->namadosen . '</div>')
            ->editColumn('kode_dosen', fn ($data) => '<div class="text-center">' . $data->kode_dosen . '</div>')
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

                $url = route('dosen.status', $row->nip);
                $btn = "<div class='d-flex justfiy-content-center'><a data-bs-toggle='modal' data-id='{$row->nip}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' data-function='afterUpdateStatus' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";

                return $btn;
            })
            ->rawColumns(['id_univ', 'namadosen', 'kode_dosen', 'action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::where('nip', $id)->first();
        if (!$dosen) return Response::error(null, 'Not Found', 404);

        return Response::success($dosen, 'Success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->first();

            $dosen->nip = $request->nip;
            $dosen->id_univ = $request->id_univ;
            $dosen->id_fakultas = $request->id_fakultas;
            $dosen->id_prodi = $request->id_prodi;
            $dosen->kode_dosen = $request->kode_dosen;
            $dosen->namadosen = $request->namadosen;
            $dosen->nohpdosen = $request->nohpdosen;
            $dosen->emaildosen = $request->emaildosen;
            $dosen->save();

            return Response::success(null, 'Dosen sudah diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
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

            return Response::success(null, 'Status Dosen successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
    
    public function import (Request $request){
        $data = $request->file('import');
        $namafile = $data-> getClientOriginalName();
        $data->move('DosenData', $namafile);
        Excel::import(new DosenImport, \public_path('/DosenData/'.$namafile));
        return \redirect()->back();
    }
}