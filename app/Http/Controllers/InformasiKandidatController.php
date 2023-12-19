<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Industri;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Yajra\DataTables\Facades\DataTables;

class InformasiKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $pendaftar = PendaftaranMagang::where('id_lowongan', $id)->get();
        $lowongan = LowonganMagang::find($id);

        return view('lowongan_magang.informasi_lowongan.detail', compact('pendaftar', 'lowongan'));
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

        $pendaftar = PendaftaranMagang::query();

        if ($request->type) {
            $pendaftar = $pendaftar->where('applicant_status', $request->type)->with("univ", "prodi", "fakultas", "lowonganMagang");
        }

        return DataTables::of($pendaftar->get())
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
