<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Http\Hash;
use Illuminate\Support\Http\Storage;
use Illuminate\Support\Http\Validator;
use Yajra\DataTables\Facades\DataTables;

class InformasiMitraController extends Controller
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
        // return auth()->user();
        // LowonganMagang::create([
        //     'id_industri'=>auth()->user()->id_industri
        // ])
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
    public function show(string $id)
    {

        $mitra = LowonganMagang::all();

        return DataTables::of($mitra)
            ->addIndexColumn()
            ->editColumn('status', function ($mitra) {
                if ($mitra->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {

                $btn = "<a href='/informasi/lowongan/' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice'></a>";

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
