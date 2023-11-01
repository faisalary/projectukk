<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universitas = Universitas::all(); // Gantilah dengan model dan metode sesuai dengan struktur basis data Anda
        $prodi = ProgramStudi::all();
        $dosen = Dosen::all();
        return view('masters.dosen.index', compact('dosen','prodi','universitas'));
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
    public function store(DosenRequest $request)
    {
        try {
            
            $dosen = Dosen::create([
                'nip' => $request->nip,
                'id_univ' => $request->namauniv,
                'id_prodi' => $request->namaprodi,
                'kode_dosen' => $request->kode_dosen,
                'namadosen' => $request->namadosen,
                'nohpdosen' => $request->nohpdosen,
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
                <a data-status='{$row->status}' data-id='{$row->nip}' data-url='dosen/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
            $dosen->id_univ = $request->namauniv;
            $dosen->kode_dosen = $request->kode_dosen;
            $dosen->id_prodi = $request->namaprodi;
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
    public function status($id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->first();
            $dosen->status = ($dosen->status) ? false : true;
            $dosen->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Dosen successfully Updated!',
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