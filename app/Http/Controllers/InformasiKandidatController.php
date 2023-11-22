<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InformasiKandidatController extends Controller
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

        return view('lowongan_magang.informasi_lowongan.detail', compact('mahasiswa', 'fakultas', 'prodi', 'universitas'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $mahasiswa = Mahasiswa::query();

        if ($request->type) {
            $mahasiswa = $mahasiswa->where('progress', $request->type)->with("univ", "prodi", "fakultas");
        }

        return DataTables::of($mahasiswa->get())
            ->addIndexColumn()
            ->editColumn('status', function ($industri) {
                // if ($industri->status == 1) {
                //     return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                // } else {
                //     return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                // }
                return null;
            })
            ->addColumn('action', function ($row) {
                // $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                // $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='offcanvas' data-bs-target='#modalslide' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>
                <a onclick = active($(this))  class='btn-icon text-danger waves-effect waves-light'><i class='tf-icons ti ti-trash'></i></a>";

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
