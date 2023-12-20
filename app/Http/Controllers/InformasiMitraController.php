<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Http\Hash;
use Illuminate\Support\Http\Storage;
use Illuminate\Support\Http\Validator;
use Yajra\DataTables\Facades\DataTables;

class InformasiMitraController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:only.lkm,', ['only' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mitra = LowonganMagang::all();

        return view('lowongan_magang.informasi_lowongan.informasi_mitra', compact('mitra'));
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
    public function show()
    {

        $mitra = Industri::with('total_lowongan')->get();

        return DataTables::of($mitra)
            ->addIndexColumn()
            ->addColumn('status', function ($mitra) {
                if ($mitra->statuskerjasama == "Ya") {
                    return "<span class='badge bg-label-success me-1'>Ya</span>";
                } else if ($mitra->statuskerjasama == "Tidak") {
                    return "<span class='badge bg-label-secondary me-1'>Tidak</span>";
                } else {
                    return "<span class='badge bg-label-info me-1'>Internal Tel-u</span>";
                }
            })
            ->addColumn('action', function ($row) {

                $btn = "<a href='/informasi/lowongan/$row->id_industri' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>";

                return $btn;
            })
            ->editColumn('total_lowongan', function ($row) {
                return $row->total_lowongan->count();
            })
            ->editColumn('total_pelamar', function ($row) {
                // return $pelamar->total_pelamar;
                // pendaftara left join lowongan magang where id
                return PendaftaranMagang::leftJoin('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
                    ->where('id_industri', $row->id_industri)
                    ->count();
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
