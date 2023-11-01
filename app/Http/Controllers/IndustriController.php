<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Industri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $industri = Industri::all();
    return view('masters.mitra.index', compact('industri'));
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
            $request->validate(
            [
                'namaindustri' => ['required', 'string', 'max:255', 'unique:industri'],
                'notelepon' => ['required', 'string', 'max:15'],
                'alamatindustri' => ['required', 'string', 'max:255'],
                'kategorimitra' => ['required', 'string', 'max:15'],
                // 'status' => ['required', 'boolean', 'default:true'],
            ],
            [
                'namaindustri.unique' => 'A Industri with the name already exist'
            ]
        );

        $industri = Industri::create([
            'namaindustri' => $request->namaindustri,
            'notelpon' => $request->notelepon,
            'alamatindustri' => $request->alamatindustri,
            'kategori_industri' => $request->kategorimitra,
            'statuskerjasama' => true,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Mitra successfully Created!',
            'modal' => '#modalTambahMitra',
            'table' => '#table-master-mitra'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
        ]);
    }
}

    /**
     * Display the spesified resource.
     */
    public function show()
    {
        $industri = Industri::orderBy('namaindustri', 'asc')->get();

        return DataTables::of($industri)
            ->addIndexColumn()
            ->editColumn('status', function ($industri) {
                if ($industri->statuskerjasama == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->statuskerjasama) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->statuskerjasama) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_industri}' onclick= edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->statuskerjasama}' data-id='{$row->id_industri}' data-url='mitra/status' class='update-status btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $industri = Industri::where('id_industri', $id)->first();
        return $industri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $industri = Industri::where('id_industri', $id)->first();

            $industri->namaindustri = $request->namaindustri;
            $industri->notelpon = $request->notelepon;
            $industri->alamatindustri = $request->alamatindustri;
            $industri->kategori_industri = $request->kategorimitra;
            $industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Mitra successfully Updated!',
                'modal' => '#modalTambahMitra',
                'table' => '#table-master-mitra'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try{
            $industri = Industri::where('id_industri', $id)->first();
            $industri->statuskerjasama = ($industri->statuskerjasama) ? false : true;
            $industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Mitra successfully Deactived!',
                'modal' => '#modalTambahMitra',
                'table' => '#table-master-mitra'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}



