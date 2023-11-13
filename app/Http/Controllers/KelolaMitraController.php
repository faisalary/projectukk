<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industri;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class KelolaMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::all();
        return view('company.kelola_mitra.index');
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
        $industri = Industri::orderBy('id_industri', 'asc')->get();

        return DataTables::of($industri)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_industri}' onclick= edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_industri}' data-url='kelola_mitra/status' class='update-status btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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