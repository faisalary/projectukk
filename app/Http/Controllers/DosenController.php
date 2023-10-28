<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Universitas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $dosen = Dosen::with('prodi','univ')->get();
        return view('masters.dosen.index', compact('dosen'));
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
        try {
            $request->validate(
                [
                    'nip' => ['required', 'integer', 'unique:dosen'],
                    'namauniv' => ['required', 'string', 'max:255'],
                    'kodedosen' => ['required', 'string', 'max:255'],
                    'namaprodi' => ['required', 'string', 'max:15'],
                    'namadosen' => ['required', 'string', 'max:15'],
                    'nohpdosen' => ['required', 'string', 'max:15'],
                    'emaildosen' => ['required', 'string', 'max:255'],
                    // 'status' => ['required', 'boolean', 'default:true'],
                ],
                [
                    'nip.unique' => 'NIP sudah ada'
                ]
            );

            $dosen = Dosen::create([
                'nip' => $request->nip,
                'namauniv' => $request->namauniv,
                'kodedosen' => $request->kodedosen,
                'namaprodi' => $request->namaprodi,
                'namadosen' => $request->namadosen,
                'nohpdosen' => $request->nohp,
                'emaildosen' => $request->emaildosen,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Dosen successfully Created!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
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
        $dosen = Dosen::with('univ','fakultas','prodi')->orderBy('nip', 'asc')->get();

        return DataTables::of($dosen)
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

                $btn = "<a data-bs-toggle='modal' data-id='{$row->nip}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = status($(this)) data-status='{$row->status}' data-id='{$row->nip}'  class='btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $dosen = Dosen::where('nip', $id)->first();
        return $dosen;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->first();

            $dosen->nip = $request->nip;
            $dosen->namauniv = $request->namauniv;
            $dosen->kodedosen = $request->kodedosen;
            $dosen->namaprodi = $request->namaprodi;
            $dosen->namadosen = $request->namadosen;
            $dosen->nohpdosen = $request->nohpdosen;
            $dosen->emaildosen = $request->emaildosen;
            $dosen->save();

            return response()->json([
                'error' => false,
                'message' => 'Dosen sudah diupdate!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
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
    public function destroy(string $id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->first();
            $dosen->status = ($dosen->status) ? false : true;
            $dosen->save();

            return response()->json([
                'error' => false,
                'message' => 'Dosen sudah di-nonaktifkan!',
                'modal' => '#modal-dosen',
                'table' => '#table-master-dosen'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}