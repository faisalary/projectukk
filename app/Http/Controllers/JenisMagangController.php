<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisMagangRequest;
use Exception;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Route;

class JenisMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenismagang = JenisMagang::all();
        return view('masters.jenis_magang.index', compact('jenismagang'));
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
    public function store(JenisMagangRequest $request)
    {
        try {

            $jenismagang = JenisMagang::create([
                'namajenis' => $request->jenis,
                'durasimagang' => $request->durasi,
                'is_document_upload' => $request->dokumen,
                'is_review_process' => $request->review,
                'type' => $request->type,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Created!',
                'modal' => '#modal-jenismagang',
                'table' => '#table-master-jenis_magang'
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
        $jenismagang = JenisMagang::orderBy('id_jenismagang', "asc")->get();

        return DataTables::of($jenismagang)
            ->addIndexColumn()
            ->editColumn('status', function ($jenismagang) {
                if ($jenismagang->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->editColumn('is_document_upload', function ($jenismagang) {
                if ($jenismagang->is_document_upload == 1) {
                    return "Ya";
                } else {
                    return "Tidak";
                }
            })
            ->editColumn('is_review_process', function ($jenismagang) {
                if ($jenismagang->is_review_process == 1) {
                    return "Ya";
                } else {
                    return "Tidak";
                }
            })
            ->editColumn('type', function ($jenismagang) {
                if ($jenismagang->type == 1) {
                    return "Fakultas";
                } else {
                    return "Non Fakultas";
                }
            })
            ->addColumn('action', function ($jenismagang) {
                $icon = ($jenismagang->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($jenismagang->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$jenismagang->id_jenismagang}'onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$jenismagang->status}' data-id='{$jenismagang->id_jenismagang}' data-url='jenis-magang/status' class='update-status btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['status', 'action'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
        return $jenismagang;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisMagangRequest $request, $id)
    {
        try {
            $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();

            $jenismagang->namajenis = $request->jenis;
            $jenismagang->durasimagang = $request->durasi;
            $jenismagang->is_document_upload = $request->dokumen;
            $jenismagang->is_review_process = $request->review;
            $jenismagang->type = $request->type;
            $jenismagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'modal' => '#modal-jenismagang',
                'table' => '#table-master-jenis_magang'
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
        try {
            $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
            $jenismagang->status = ($jenismagang->status) ? false : true;
            $jenismagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Status successfully updated!',
                'modal' => '#modalTambahJenisMagang',
                'table' => '#table-master-jenis_magang'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
