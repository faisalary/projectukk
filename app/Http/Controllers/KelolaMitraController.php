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
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->namaindustri}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->namaindustri}' data-url='kelola_mitra/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->addColumn('aksi', function ($row) {
                $btn = "<a data-bs-toggle='modal' class='btn-icon'>
                <i class='btn-icon ti ti-file-check text-success'></i>
                <i class='btn-icon ti ti-file-x text-danger'></i></a>";
        
                return $btn;
            })
            
            ->rawColumns(['status','action','aksi'])
            ->make(true);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $industri = Industri::where('id_industri', $id)->first();
        return $industri;
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