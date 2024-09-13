<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\PosisiMagangRequest;
use App\Models\PosisiMagang;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class PosisiMagangController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:posisi_magang.view');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posisiMagang = PosisiMagang::all();
        return view('masters.posisi_magang.index', ['posisiMagang' => $posisiMagang]);
    }  

    /**
     * Store a newly created resource in storage.
     */
    public function store(PosisiMagangRequest $request)
    {
        try {
            PosisiMagang::create([
                'name' => $request->name,              
            ]);

            return Response::success(null, 'Posisi Magang berhasil ditambahkan');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $posisiMagang = PosisiMagang::all();
        
        return DataTables::of($posisiMagang)
            ->addIndexColumn()   
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-primary'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })         
            ->addColumn('action', function ($row) {                               
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";

                $url = route('posisimagang.status', $row->id_posisi_magang);
                $btn = "<div class='text-center'><a data-bs-toggle='modal' data-id='{$row->id_posisi_magang}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' data-function='afterUpdateStatus' class='cursor-pointer mx-1 update-status text-{$color}'><i class='tf-icons ti {$icon}'></i></a></div>";

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
        $posisiMagang = PosisiMagang::where('id_posisi_magang', $id)->first();
        return $posisiMagang;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PosisiMagangRequest $request, string $id)
    {
        try {
            $posisiMagang = PosisiMagang::where('id_posisi_magang', $id)->first();
            if (!$posisiMagang) return Response::error(null, 'Posisi Magang not found!');

            $posisiMagang->name = $request->name;
            $posisiMagang->update();        

            return Response::success(null, 'Posisi Magang berhasil diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }  

    public function status($id)
    {
        try {
            $posisiMagang = PosisiMagang::where('id_posisi_magang', $id)->first();
            $posisiMagang->status = !$posisiMagang->status;
            $posisiMagang->save();

            return Response::success(null, 'Status Posisi Magang berhasil diupdate!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}
