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
        try{
            $industri = Industri::create([
            'namaindustri' => $request->namaindustri,
            'email' => $request->email,
            'kategori_industri' => $request->kategori_industri,
            'statuskerjasama' => $request->statuskerjasama,
            'status' => true,
        ]);

            return response()->json([
                'error' => false,
                'message' => 'Industri successfully Created!',
                'modal' => '#modalTambahMitra',
                'table' => '#table-kelola-mitra1'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $industri = Industri::orderBy('namaindustri', 'asc')->get();

        return DataTables::of($industri)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->rawColumns(['status'])
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

    public function status($id)
    {
        try {
            $industri = Industri::where('namaindustri', $id)->first();
            $industri->status = ($industri->status) ? false : true;
            $industri->save();

            return response()->json([
                'error' => false,
                'table' => '#table-kelola-mitra3'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}