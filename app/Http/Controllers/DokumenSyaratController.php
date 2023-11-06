<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokumenSyaratRequest;
use Exception;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use App\Models\DocumentSyarat;
use Yajra\DataTables\Facades\DataTables;

class DokumenSyaratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doc = DocumentSyarat::all();
        $jenis = JenisMagang::all();
        return view('masters.dokumen_persyaratan.index', compact('doc', 'jenis'));
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
    public function store(DokumenSyaratRequest $request)
    {
        try {

            DocumentSyarat::create([
                'namadocument' => $request->namadoc,
                'id_jenismagang' => $request->namajenis,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Document successfully Add!',
                'modal' => '#modal-dokumen',
                'table' => '#table-master-dokumen'
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
        $doc = DocumentSyarat::with('jenis')->orderBy('id_jenismagang', 'asc')->get();

        return DataTables::of($doc)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_document}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_document}' data-url='dokumen-persyaratan/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $doc = DocumentSyarat::where('id_document', $id)->first();
        return $doc;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DokumenSyaratRequest $request, string $id)
    {
        try {
            $doc = DocumentSyarat::where('id_document', $id)->first();

            $doc->id_jenismagang = $request->namajenis;
            $doc->namadocument = $request->namadoc;
            $doc->save();

            return response()->json([
                'error' => false,
                'message' => 'Document successfully Updated!',
                'modal' => '#modal-dokumen',
                'table' => '#table-master-dokumen'
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
            $doc = DocumentSyarat::where('id_document', $id)->first();
            $doc->status = ($doc->status) ? false : true;
            $doc->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Document successfully Updated!',
                'modal' => '#modal-dokumen',
                'table' => '#table-master-dokumen'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
